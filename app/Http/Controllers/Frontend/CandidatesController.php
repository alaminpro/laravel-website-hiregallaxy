<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\ImageUploadHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\AptitudeResult;
use App\Models\Category;
use App\Models\Country;
use App\Models\Experience;
use App\Models\Job;
use App\Models\Personality;
use App\Models\PersonalityResult;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class CandidatesController extends Controller
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

        $users = User::where('status', 1)->where('is_company', 0)->paginate($paginateNumber);

        $total_user = count($users);

        $pageNoText = $paginateNumber * $pageNo . ' to ' . ($pageNo * $paginateNumber + $total_user);

        return view('frontend.pages.candidates.index', compact('users', 'pageNoText'));

    }

    public function show($username)
    {

        $user = User::where('username', $username)->first();

        if (is_null($user)) {

            session()->flash('error', 'No Candidate has been found !!');

            return redirect()->route('candidates');

        }

        return view('frontend.pages.candidates.show', compact('user'));

    }

    public function showResume($username)
    {

        $user = User::where('username', $username)->first();

        $data = [

            'user' => $user,

        ];

        // return view('frontend.pages.candidates.show-resume', compact('data'));

        $pdf = PDF::loadView('frontend.pages.candidates.show-resume', compact('data'));

        return $pdf->stream('candidate-resume.pdf');

    }

    public function search(Request $request)
    {

        $search = $categories = $category = $country = $country_id = $category_id = null;

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

                left join candidate_profiles on users.id = candidate_profiles.user_id

                left join locations on locations.id = users.location_id

                where is_company = 0 and status=1

        ';

        if ($request->search && $request->search != '') {

            $sql .= " and users.name like '%$request->search%' or users.about like '%$request->search%'";

        }

        if ($request->country && $request->country != 'all') {

            $country = $request->country;

            $country_id = Country::where('name', $country)->first()->id;

            $sql .= " and locations.country_id = $country_id ";

        }

        if ($request->category != null && $request->category != 'all') {

            $category = $request->category;

            $category_id = Category::where('slug', $category)->first()->id;

            $sql .= " and candidate_profiles.sector = $category_id ";

        }

        $experience_id = null;

        if ($request->experience != null && $request->experience != '') {

            $experience_id = Experience::where('slug', $request->experience)->first()->id;

            $sql .= " and candidate_profiles.experience_id = $experience_id";

        }

        $gender = null;

        if ($request->gender != null && $request->gender != '') {

            $sql .= " and candidate_profiles.gender = '$request->gender'";

        }

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $user_ids = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = User::whereIn('id', $user_ids)->paginate($paginateNumber);

        $total_users = count($users);

        $pageNoText = $paginateNumber * $pageNo . ' to ' . ($pageNo * $paginateNumber + $total_users);

        return view('frontend.pages.candidates.index', compact('users', 'categories', 'pageNoText', 'search', 'country', 'category'));

    }

    /**

     * Candidate Profile Updates

     */

    public function changeProfilePicture(Request $request)
    {}

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

            'date_of_birth' => 'required',

            'career_level_id' => 'required',

            'sector' => 'required|numeric',

            'gender' => 'required',

            'profile_picture' => 'nullable|image',

            'cv' => 'nullable|mimes:pdf',

            'facebook_link' => 'nullable|url',

            'twitter_link' => 'nullable|url',

            'linkedin_link' => 'nullable|url',

            'google_plus_link' => 'nullable|url',

        ], [

            'career_level_id.required' => 'Please select your career level !!',

        ]);

        $user = User::find($user_id);

        $user->name = $request->name;

        $user->facebook_link = $request->facebook_link;

        $user->twitter_link = $request->twitter_link;

        $user->linkedin_link = $request->linkedin_link;

        $user->google_plus_link = $request->google_plus_link;

        if ($request->profile_picture) {

            $user->profile_picture = ImageUploadHelper::update('profile_picture', $request->file('profile_picture'), 'pr-' . time(), 'public/images/users', 'public/images/users/' . $user->profile_picture);

        }

        $user->save();

        if ($request->cv) {

            $user->candidate->update([

                'date_of_birth' => $request->date_of_birth,

                'cv' => UploadHelper::update('cv', $request->file('cv'), 'cv-' . time(), 'files/cv', 'files/cv/' . $user->candidate->cv),

                'sector' => $request->sector,

                'gender' => $request->gender,

                'career_level_id' => $request->career_level_id,

            ]);

        } else {

            $user->candidate->update([

                'date_of_birth' => $request->date_of_birth,

                'sector' => $request->sector,

                'gender' => $request->gender,

                'career_level_id' => $request->career_level_id,

            ]);

        }

        session()->flash('success', 'Your profile information has been updated !!');

        return back();

    }

    public function favoriteJobs()
    {

        if (!Auth::check()) {

            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');

            return back();

        }

        $user = Auth::user();

        $user_id = $user->id;

        $job_ids = DB::table('job_favorites')->select('job_id')->where('user_id', Auth::id())->get();

        $pdo = DB::connection()->getPdo();

        $sql = "select job_favorites.job_id

                from job_favorites

                left join users on job_favorites.user_id = users.id

                where users.id = $user_id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $job_ids = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $jobs = Job::whereIn('id', $job_ids)->paginate(20);

        return view('frontend.pages.candidates.favorite-jobs', compact('user', 'jobs'));

    }

    public function dashboard()
    {

        if (!Auth::check()) {

            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');

            return back();

        }

        $user = Auth::user();

        $personality = PersonalityResult::where('user_id', auth()->user()->id)->select('id', 'personality_result')->first();

        $aptitude = AptitudeResult::where('user_id', auth()->user()->id)->select('id', 'result')->first();

        return view('frontend.pages.candidates.dashboard', compact('user', 'personality', 'aptitude'));

    }

    public function Personality()
    {

        if (!Auth::check()) {

            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');

            return back();

        }

        $user = Auth::user();

        $personality_result = PersonalityResult::where('user_id', $user->id)->select('id', 'personality_result')->first();

        $personality = Personality::where('title', '=', $personality_result['personality_result'])

            ->select('id', 'title', 'sub_title', 'description', 'strengths', 'weaknesses')->first();

        return view('frontend.pages.candidates.personality', compact('personality', 'user'));

    }

    public function appliedJobs()
    {

        if (!Auth::check()) {

            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');

            return back();

        }

        $user = Auth::user();

        $user_id = $user->id;

        $pdo = DB::connection()->getPdo();

        $sql = "select job_activities.job_id

                from job_activities

                left join users on job_activities.user_id = users.id

                where users.id = $user_id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $job_ids = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $jobs = Job::whereIn('id', $job_ids)->paginate(20);

        return view('frontend.pages.candidates.applied-jobs', compact('user', 'jobs'));

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

        return view('frontend.pages.candidates.messages', compact('user', 'received_messages', 'sent_messages'));

    }

}
