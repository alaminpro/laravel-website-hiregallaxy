<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\CandidateProfile;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\Job;
use App\Models\JobActivity;
use App\Models\Result;
use App\Models\UserQualification;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmployersController extends Controller
{
    public function index(Request $request)
    {
        $paginateNumber = 20;
        // You are watching text
        if ($request->page) {
            $pageNo = $request->page;
        } else {
            $pageNo = 0;
        }

        $users = User::where('status', 1)->where('is_company', 1)->paginate($paginateNumber);
        $total_user = count($users);
        $pageNoText = $paginateNumber * $pageNo . ' to ' . ($pageNo * $paginateNumber + $total_user);

        return view('frontend.pages.employers.index', compact('users', 'pageNoText'));
    }

    public function show($username)
    {
        $user = User::where('username', $username)->first();
        if (is_null($user)) {
            session()->flash('error', 'No Employer has been found !!');
            return redirect()->route('employers');
        }
        //       $user->company->update([
        //           'total_view' => $user->company->total_view + 1
        //       ]);
        $company = CompanyProfile::where('user_id', $user->id)->first();
        $company->total_view = $company->total_view + 1;
        $company->save();
        $results = Result::where('status', 1)->select('job_id')->get();
        return view('frontend.pages.employers.show', compact('user', 'results'));
    }

    public function search(Request $request)
    {
        $search = $country = $country_id = $category_id = null;

        $categories = Category::orderBy('name', 'asc')->where('status', 1)->get();

        $paginateNumber = 20;
        // You are watching text
        if ($request->page) {
            $pageNo = $request->page;
        } else {
            $pageNo = 0;
        }

        $pdo = DB::connection()->getPdo();
        $sql = 'select users.id
                from users
                left join company_profiles on users.id = company_profiles.user_id
                left join locations on locations.id = users.location_id
                left join jobs on jobs.user_id = users.id
                where users.is_company=1 and users.status=1
        ';

        if ($request->search && $request->search != '') {
            //$sql .= " and users.name like '%$request->search%' or users.about like '%$request->search%' or jobs.title like '%$request->search%'";
            $sql .= " and users.name like '%$request->search%' ";
        }

        if ($request->country && $request->country != 'all') {
            $country = $request->country;
            $country_id = Country::where('name', $country)->first()->id;
            $sql .= " and locations.country_id = $country_id ";
        }

        if ($request->category != null && $request->category != 'all') {
            $category = $request->category;
            $category_id = Category::where('slug', $category)->first()->id;
            $sql .= " and company_profiles.category_id = $category_id ";
        }

        $team = null;
        if ($request->team != null && $request->team != '') {
            $sql .= " and company_profiles.team_member = '$request->team'";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $user_ids = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = User::whereIn('id', $user_ids)->paginate($paginateNumber);

        $total_users = count($users);
        $pageNoText = $paginateNumber * $pageNo . ' to ' . ($pageNo * $paginateNumber + $total_users);

        return view('frontend.pages.employers.index', compact('users', 'categories', 'pageNoText', 'search', 'country', 'category'));
    }

    public function updateAbout(Request $request, $user_id)
    {
        if (!Auth::check() && Auth::id() != $user_id) {
            session()->flash('error', 'Sorry !! You are not permitted to do this action');
            return back();
        }

        $this->validate($request, [
            'about' => 'required',
        ]);

        $user = User::find($user_id);
        $user->about = $request->about;
        session()->flash('success', 'Your profile about information has been updated !!');
        $user->save();
        return back();
    }

    public function updateProfile(Request $request, $user_id)
    {
        if (!Auth::check() && Auth::id() != $user_id) {
            session()->flash('error', 'Sorry !! You are not permitted to do this action');
            return back();
        }

        $this->validate($request, [
            'name' => 'required|max:30',
            'category_id' => 'required|numeric',
            'profile_picture' => 'nullable|image',
            'website' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'google_plus_link' => 'nullable|url',
        ]);

        $user = User::find($user_id);
        $user->name = $request->name;
        $user->website = $request->website;
        $user->facebook_link = $request->facebook_link;
        $user->twitter_link = $request->twitter_link;
        $user->linkedin_link = $request->linkedin_link;
        $user->google_plus_link = $request->google_plus_link;
        $user->phone_no = $request->phone_no;

        if ($request->profile_picture) {
            $user->profile_picture = ImageUploadHelper::update('profile_picture', $request->file('profile_picture'), 'pr-' . time(), 'images/users', 'images/users/' . $user->profile_picture);
        }
        $user->save();

        $user->company->update([
            'category_id' => $request->category_id,
            'establish_date' => $request->establish_date,
            'establish_year' => substr($request->establish_date, 0, 4),
            'team_member' => $request->team_member,
        ]);

        // If not empty sectors[] then add this to user_sectors table
        if (count($request->sectors) != 0) {

            // Delete all existings
            $user_id = $user->id;
            DB::table('user_sectors')->where('user_id', $user_id)->delete();

            foreach ($request->sectors as $sector) {
                $sector_id = $sector;
                DB::table('user_sectors')->insert([
                    'sector_id' => $sector_id,
                    'user_id' => $user_id,
                ]);
            }
        }

        session()->flash('success', 'Your profile information has been updated !!');
        return back();
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');
            return back();
        }
        $user = Auth::user();
        return view('frontend.pages.employers.dashboard', compact('user'));
    }

    public function favoriteJobs()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');
            return back();
        }
        $user = Auth::user();
        $user_id = $user->id;
        $pdo = DB::connection()->getPdo();
        $sql = "select job_favorites.job_id
                from job_favorites
                left join users on job_favorites.user_id = users.id
                where users.id = $user_id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $job_ids = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $jobs = Job::whereIn('id', $job_ids)->paginate(20);

        return view('frontend.pages.employers.favorite-jobs', compact('user', 'jobs'));
    }

    public function postedJobs()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');
            return back();
        }
        $user = Auth::user();
        $user_id = $user->id;
        $jobs = Job::where('user_id', $user_id)->paginate(20);

        return view('frontend.pages.employers.posted-jobs', compact('user', 'jobs'));
    }

    public function messages()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');
            return back();
        }
        $user = Auth::user();
        $user_id = $user->id;
        $received_messages = $user->received_messages()->paginate(20);
        $sent_messages = $user->sent_messages()->paginate(20);

        $user->received_messages()->update(['is_seen' => 1]);
        return view('frontend.pages.employers.messages', compact('user', 'received_messages', 'sent_messages'));
    }

    public function jobApplications($slug)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');
            return back();
        }
        $user = Auth::user();
        $user_id = $user->id;
        $job = Job::where('slug', $slug)->first();
        $applications = JobActivity::where('job_id', $job->id)->get();
        $results = [];
        $experiences = [];
        $education = [];
        foreach ($applications as $application) {
            $results[] = Result::where('job_id', $application->job_id)->where('user_id', $application->user_id)->get();
            $experiences[] = CandidateProfile::with('experience')->where('user_id', $application->user_id)->first();
            $education[] = UserQualification::where('user_id', $application->user_id)->first();
        }
        $results = $results[0];
        $education = $education[0];
        $experience = $experiences[0];

        return view('frontend.pages.employers.job-applications', compact('user', 'job', 'applications', 'results', 'experience', 'education'));

    }

    /**
     * deleteJob
     *
     * @param string $slug
     * @return void
     */
    public function deleteJob($slug)
    {
        //Find Job
        $job = Job::where('slug', $slug)->first();
        if (!is_null($job)) {
            if (!Auth::check() && $job->user_id !== Auth::id()) {
                session()->flash('error', 'Sorry !! You are not an authenticated Employer to delete this job !!');
                return back();
            }

            // Delete All job activities
            $jobActivities = JobActivity::where('job_id', $job->id)->get();
            foreach ($jobActivities as $activity) {

                // Get User and check if the CV is not the user default CV,
                // if not then delete the cv from file path
                $appliedUser = CandidateProfile::where('user_id', $activity->user_id)->first();
                if (!is_null($appliedUser)) {
                    $uploaded_cv = $activity->cv;
                    $user_cv = url('/files/cv/') . $appliedUser->cv;
                    if ($user_cv != $uploaded_cv) {
                        // Delete Uploaded New CV for that jobs
                        if (File::exists($uploaded_cv)) {
                            unlink($uploaded_cv);
                        }
                    }
                }
                $activity->delete();
            }

            $job->delete();
            session()->flash('success', 'Job has been deleted !!');
        } else {
            session()->flash('error', 'No job has been found !!');
        }
        return back();
    }
}