<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Helpers\ImageUploadHelper;
use App\Helpers\UploadHelper;
use App\Helpers\StringHelper;

use App\Models\JobType;
use App\Models\Currency;
use App\Models\Country;
use App\Models\Job;
use App\Models\JobActivity;
use App\Models\JobApplyType;
use App\Models\JobQualification;
use App\Models\JobSkill;
use App\Models\JobStatus;
use App\Models\JobTag;
use App\Models\Experience;
use App\Models\Location;
use App\Models\Skill;
use App\Models\Category;
use App\Models\Qualification;
use App\Models\Setting;
use App\Models\Template;
use App\User;
use Auth;

class JobsController extends Controller
{

    /**
     * index
     * @param  Request $request 
     * @return view
     */
    public function index(Request $request)
    {

        // $ip = $_SERVER['REMOTE_ADDR'];
        // if ($ip == "::1") {
        //     $ip = "128.100.33.149";
        // }

        // $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        // $user_city = $details->city;
        // if (!is_null(Country::where('name', $user_city)->first())) {
        //     $city_id = Country::where('name', $user_city)->first()->id;
        // }


        $categories = Category::orderBy('name', 'asc')->where('status', 1)->get();

        $paginateNumber = 20;
        // You are watching text
        if ($request->page) {
            $pageNo = $request->page;
        } else {
            $pageNo = 0;
        }

        $jobs = Job::where('is_confirmed', 1)->orderBy('id', 'desc')->where('status_id', 1)->paginate($paginateNumber);
        // if (isset($city_id) && !is_null($city_id) && $city_id != '' && $city_id != 0) {
        //     $jobs = Job::where('is_confirmed', 1)->where('status_id', 1)->orderByRaw(DB::raw("FIELD(country_id , '$city_id') DESC"))->orderBy('id', 'DESC')->paginate($paginateNumber);
        // }
        //orderByRaw('FIELD(language, "USD", "EUR", "JPN")')

        $total_jobs = count($jobs);
        $pageNo = $pageNo != 0 ? $pageNo - 1 : $pageNo;
        $pageNoText = $paginateNumber * $pageNo . ' to ' . ($pageNo * $paginateNumber + $total_jobs);

        return view('frontend.pages.jobs.index', compact('jobs', 'categories', 'pageNoText'));
    }

    public function category(Request $request, $slug)
    {
        // $ip = $_SERVER['REMOTE_ADDR'];
        // if ($ip == "::1") {
        //     $ip = "128.100.33.149";
        // }

        // $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        // $user_city = $details->city;
        // if (!is_null(Country::where('name', $user_city)->first())) {
        //     $city_id = Country::where('name', $user_city)->first()->id;
        // }

        $categories = Category::orderBy('name', 'asc')->where('status', 1)->get();
        $category = Category::where('slug', $slug)->where('status', 1)->first();
        if (is_null($category)) {
            return redirect()->route('index');
        }

        $paginateNumber = 20;
        // You are watching text
        if ($request->page) {
            $pageNo = $request->page;
        } else {
            $pageNo = 0;
        }


        $jobs = Job::where('is_confirmed', 1)->where('category_id', $category->id)->where('status_id', 1)->orderBy('id', 'desc')->paginate($paginateNumber);

        // if (isset($city_id) && !is_null($city_id) && $city_id != '' && $city_id != 0) {
        //     $jobs = Job::where('is_confirmed', 1)->where('category_id', $category->id)->where('status_id', 1)->orderByRaw(DB::raw("FIELD(country_id , '$city_id') DESC"))->orderBy('id', 'DESC')->paginate($paginateNumber);
        // }

        $total_jobs = count($jobs);
        $pageNo = $pageNo != 0 ? $pageNo - 1 : $pageNo;
        $pageNoText = $paginateNumber * $pageNo . ' to ' . ($pageNo * $paginateNumber + $total_jobs);

        return view('frontend.pages.jobs.index', compact('jobs', 'categories', 'category', 'pageNoText'));
    }


    /**
     * searchJob
     * 
     * @param  Request $request 
     * @return [type]           
     */
    public function searchJob(Request $request)
    {
        // Fetch User City
        // $ip = $_SERVER['REMOTE_ADDR'];
        // if ($ip == "::1") {
        //     $ip = "128.100.33.149";
        // }

        // $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        // $user_city = $details->city;
        // if (!is_null(Country::where('name', $user_city)->first())) {
        //     $city_id = Country::where('name', $user_city)->first()->id;
        // }

        $search = $country = $country_id = $category_id = null;
        $salary_min = 0;
        $salary_max = null;

        if ($request->title) {
            $search = $request->title;
        }

        if ($request->country && $request->country != 'all') {
            $country = $request->country;
            $country_id = Country::where('name', $country)->first()->id;
        }

        if ($request->category != null && $request->category != 'all') {
            $category = $request->category;
            $category_id = Category::where('slug', $category)->first()->id;
        }

        $min_salary = 0;
        $max_salary = 100000;
        if ($request->salary != null && $request->salary != '') {
            $salaryPart = explode("-", $request->salary);
            $min_salary = $salaryPart[0];
            if (isset($salaryPart[1])) {
                $max_salary = $salaryPart[1];
            }
        }

        $type_id = null;
        if ($request->type != null && $request->type != '') {
            $type_id = $request->type;
        }

        $categories = Category::orderBy('name', 'asc')->where('status', 1)->get();

        $paginateNumber = 20;
        // You are watching text
        if ($request->page) {
            $pageNo = $request->page;
        } else {
            $pageNo = 0;
        }

        $pdo = DB::connection()->getPdo();
        $sql = 'select jobs.id
        from jobs 
        left join users on users.id = jobs.id
        left join categories on jobs.category_id = categories.id
        left join job_types on job_types.id = jobs.type_id
        where 1 = 1  
        ';

        if ($request->search && $request->search != '') {
            $sql .= " and jobs.title like '%$request->search%' or jobs.description like '%$request->search%'";
        }

        if ($request->country && $request->country != 'all') {
            $country = $request->country;
            $country = Country::where('name', $country)->first();

            if (!is_null($country)) {
                $country_id = $country->id;
                $sql .= " and jobs.country_id = $country_id ";
            }
        }

        if ($request->category != null && $request->category != 'all') {
            $category = $request->category;
            $category = Category::where('slug', $category)->first();
            if (!is_null($category)) {
                $category_id =  $category->id;
                $sql .= " and jobs.category_id = $category_id ";
            }
        }

        $min_salary = 0;
        $max_salary = 100000;
        if ($request->salary != null && $request->salary != '') {
            $salaryPart = explode("-", $request->salary);
            $min_salary = $salaryPart[0];
            if (isset($salaryPart[1])) {
                $max_salary = $salaryPart[1];
            }
            $sql .= " and jobs.monthly_salary  between  $min_salary and $max_salary ";
        }

        $type_id = null;
        if ($request->type != null && $request->type != '') {
            $type = JobType::where('name', $request->type)->first();
            if (!is_null($type)) {
                $type_id =  $type->id;
                $sql .= " and jobs.type_id = $type_id";
            }
        }

        $experience_id = null;
        if ($request->experience != null && $request->experience != '') {
            $experience = Experience::where('slug', $request->experience)->first();
            if (!is_null($experience)) {
                $experience_id =  $experience->id;
                $sql .= " and jobs.experience_id = $experience_id";
            }
        }


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $job_ids = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $jobs = Job::whereIn('id', $job_ids)->paginate($paginateNumber);
        // if (isset($city_id) && !is_null($city_id) && $city_id != '' && $city_id != 0) {
        //     $jobs = Job::whereIn('id', $job_ids)->orderByRaw(DB::raw("FIELD(country_id , '$city_id') DESC"))->orderBy('id', 'DESC')->paginate($paginateNumber);
        // }

        $total_jobs = count($jobs);
        $pageNo = $pageNo != 0 ? $pageNo - 1 : $pageNo;
        $pageNoText = $paginateNumber * $pageNo . ' to ' . ($pageNo * $paginateNumber + $total_jobs);

        return view('frontend.pages.jobs.index', compact('jobs', 'categories', 'pageNoText', 'search', 'country', 'category'));
    }

    /**
     * show
     * 
     * @param  string
     * @return view
     */
    public function show($slug)
    {
        $job = Job::where('slug', $slug)->first();
        if (!is_null($job)) {
            $similar_jobs = Job::where('category_id', $job->category->id)->where('status_id', 1)->where('id', '!=', $job->id)->limit(3)->get();
            return view('frontend.pages.jobs.show', compact('job', 'similar_jobs'));
        }

        session()->flash('error', 'Sorry !! No job has found !!');
        return redirect()->route('index');
    }

    /**
     * post
     *
     * Job Post Page
     *      
     * @return  view
     */
    public function post()
    {
        $job_types = JobType::where('status', 1)->get();
        $job_experiences = Experience::where('status', 1)->get();
        $job_apply_types = JobApplyType::where('status', 1)->get();
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();
        $qualifications = Qualification::where('status', 1)->orderBy('name', 'asc')->get();
        $skills = Skill::where('status', 1)->orderBy('name', 'asc')->get();
        $currencies = Currency::orderBy('priority', 'asc')->get();
        $countries = Country::orderBy('name', 'asc')->get();
        $templates = Template::orderBy('name', 'asc')->get();
        return view('frontend.pages.jobs.post-job', compact('job_types', 'job_experiences', 'job_apply_types', 'categories', 'skills', 'qualifications', 'currencies', 'countries', 'templates'));
    }

    /**
     * store
     *
     * Add New Job Post
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {

        if (!Auth::check() || !User::userCanPost(Auth::id())) {
            session()->flash('error', 'Sorry !! You are not permitted to post a job !!');
            return redirect()->route('jobs');
        }

        $this->validate($request, [
            'title' => 'required|max:150',
            'template_id' => 'required|max:150',
            'email' => 'required|email',
            'type_id' => 'required',
            'apply_type_id' => 'required',
            'location' => 'nullable',
            'deadline' => 'required'
        ]);

        $job = new Job();
        $template_id = $request->template_id;
        $template = Template::find($template_id);
        if (!is_null($template)) {
            $job->template_id =  $template_id;
            $job->title =  trim($template->name);
            $job->slug = StringHelper::createSlug($template->name, 'Job', 'slug');;
            $job->email = $request->email;
            $job->description = $request->description;
            $job->category_id = $template->category_id;
            $job->type_id = $request->type_id;
            $job->experience_id = $request->experience_id;
            $job->apply_type_id = $request->apply_type_id;

            $job->location = trim($request->location);
            $job->country_id = $request->country;

            if (isset($request->is_salary_negotiable)) {
                $job->is_salary_negotiable = 1;
            } else {
                $job->is_salary_negotiable = 0;

                $this->validate($request, [
                    'monthly_salary' => 'required',
                    'salary_currency' => 'required'
                ]);

                $job->monthly_salary = $request->monthly_salary;
                $job->salary_currency = $request->salary_currency;
            }

            $job->gender = $request->gender;

            // Deadline Customization
            $getDeadline = $request->deadline; //04/30/2019
            //2019-04-18 00:00:00
            $getDeadline = substr($getDeadline, 6, 4) . '-' . substr($getDeadline, 0, 2) . '-' . substr($getDeadline, 3, 2);
            $job->deadline = $getDeadline;

            $job->is_featured = 1; // Featured Job By Default
            $job->is_confirmed = 1;
            $job->user_id = Auth::id();
            $job->status_id = 1; // Open

            // Textareas
            $enable_editing = Setting::first()->enable_job_editing;
            if (!$enable_editing) {
                $job->job_summery = $template->job_summery;
                $job->responsibilities = $template->responsibilities;
                $job->qualification = $template->qualification;
                $job->certification = $template->certification;
                $job->experience = $template->experience;
                $job->about_company = $template->about_company;
            } else {
                $job->job_summery = $request->job_summery;
                $job->responsibilities = $request->responsibilities;
                $job->qualification = $request->qualification;
                $job->certification = $request->certification;
                $job->experience = $request->experience;
                $job->about_company = $request->about_company;
                $job->save();
            }

            session()->flash('success', 'Job has been posted successfully !!');
            return redirect()->route('jobs');
        } else {
            session()->flash('error', 'Please select job title..');
            return back();
        }
    }

    /**
     * Job Post Edit page
     * 
     * @param  view $slug 
     * @return view
     */
    public function edit($slug)
    {
        if (!Auth::check() || !User::userCanPost(Auth::id())) {
            session()->flash('error', 'Sorry !! You are not permitted to edit the job !!');
            return redirect()->route('jobs');
        }

        $job = Job::where('slug', $slug)->first();
        if (is_null($job)) {
            session()->flash('error', 'Sorry !! No job has found !!');
            return redirect()->route('index');
        }

        if (!Auth::check() && Auth::user()->id != $job->id) {
            session()->flash('error', 'Sorry !! You are not authenticated to edit this job !!');
            return redirect()->route('index');
        }

        $job_types = JobType::where('status', 1)->get();
        $job_experiences = Experience::where('status', 1)->get();
        $job_apply_types = JobApplyType::where('status', 1)->get();
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();
        $qualifications = Qualification::where('status', 1)->orderBy('name', 'asc')->get();
        $skills = Skill::where('status', 1)->orderBy('name', 'asc')->get();
        $currencies = Currency::orderBy('priority', 'asc')->get();
        $countries = Country::orderBy('name', 'asc')->get();
        $job_deadline = substr($job->deadline, 5, 2) . '/' . substr($job->deadline, 8, 2) . '/' . substr($job->deadline, 0, 4); //2019-04-18 to 04/10/2019 
        $templates = Template::orderBy('name', 'asc')->get();
        return view('frontend.pages.jobs.edit', compact('job_types', 'job_experiences', 'job_apply_types', 'categories', 'skills', 'qualifications', 'currencies', 'countries', 'job', 'job_deadline', 'templates'));
    }


    /**
     * update Job
     * 
     * @param  Request $request 
     * @return Route           
     */
    public function update(Request $request, $slug)
    {
        if (!Auth::check() || !User::userCanPost(Auth::id())) {
            session()->flash('error', 'Sorry !! You are not permitted to edit the job !!');
            return redirect()->route('jobs');
        }

        $job = Job::where('slug', $slug)->first();

        $this->validate($request, [
            'title' => 'required|max:150',
            'template_id' => 'required|max:150',
            'email' => 'required|email',
            'type_id' => 'required',
            'apply_type_id' => 'required',
            'location' => 'nullable',
            'deadline' => 'required'
        ]);

        $template_id = $request->template_id;
        $template = Template::find($template_id);
        $job->template_id =  $template_id;
        $job->title =  trim($template->name);
        // $job->slug = StringHelper::createSlug($template->name, 'Job', 'slug');;
        $job->email = $request->email;
        $job->description = $request->description;
        $job->category_id = $template->category_id;
        $job->type_id = $request->type_id;
        $job->experience_id = $request->experience_id;
        $job->apply_type_id = $request->apply_type_id;

        $job->location = trim($request->location);
        $job->country_id = $request->country;

        if (isset($request->is_salary_negotiable)) {
            $job->is_salary_negotiable = 1;
        } else {
            $job->is_salary_negotiable = 0;

            $this->validate($request, [
                'monthly_salary' => 'required',
                'salary_currency' => 'required'
            ]);

            $job->monthly_salary = $request->monthly_salary;
            $job->salary_currency = $request->salary_currency;
        }

        $job->gender = $request->gender;

        // Deadline Customization
        $getDeadline = $request->deadline; //04/30/2019
        //2019-04-18 00:00:00
        $getDeadline = substr($getDeadline, 6, 4) . '-' . substr($getDeadline, 0, 2) . '-' . substr($getDeadline, 3, 2);
        $job->deadline = $getDeadline;

        // $job->is_featured = 1; // Featured Job By Default
        // $job->is_confirmed = 1;
        $job->user_id = Auth::id();
        // $job->status_id = 1; // Open

        // Textareas
        $job->job_summery = $request->job_summery;
        $job->responsibilities = $request->responsibilities;
        $job->qualification = $request->qualification;
        $job->certification = $request->certification;
        $job->experience = $request->experience;
        $job->about_company = $request->about_company;
        $job->save();

        session()->flash('success', 'Job has been updated successfully !!');
        return back();
    }


    /**
     * Apply For Jobs
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function apply(Request $request)
    {

        if (!Auth::check()) {
            session()->flash('error', 'Sorry !! You are not permitted to apply job !!');
            return back();
        }

        $this->validate($request, [
            'job_id' => 'required|numeric',
            'cover_letter' => 'required',
            'expected_salary' => 'nullable|numeric',
            'cv_file' => 'nullable|mimes:pdf|max:2000'
        ]);

        if (JobActivity::where('user_id', Auth::id())->where('job_id', $request->job_id)->first() != null) {
            session()->flash('error', 'Sorry !! You have already applied for this job !!');
            return back();
        }

        $jobActivity = new JobActivity();
        $jobActivity->job_id = $request->job_id;
        $jobActivity->user_id = Auth::id();
        $jobActivity->cover_letter = $request->cover_letter;

        if (isset($request->is_salary_negotiable)) {
            $jobActivity->is_salary_negotiable = 1;
            $jobActivity->expected_salary = 0;
        } else {
            $jobActivity->is_salary_negotiable = 0;
            $jobActivity->expected_salary = $request->expected_salary;
        }

        if (isset($request->use_profile_cv)) {
            if (Auth::user()->candidate->cv != null) {
                $cv = Auth::user()->candidate->cv;
            } else {
                $cv = NULL;
            }
        } else {
            // If there is any uploaded CV

            $cv_file = UploadHelper::upload('cv_file', $request->file('cv_file'), time(), 'public/files/cv');
            if (!is_null($cv_file)) {
                $cv = url('/') . '/public/files/cv/' . $cv_file;
            } else {
                $cv = NULL;
            }
        }
        $jobActivity->cv = $cv;
        $jobActivity->save();

        session()->flash('success', 'You have applied successfully for the job !!');
        return redirect()->route('jobs');
    }


    /**
     * applyUpdate
     * @param  Request $request 
     * @return            
     */
    public function applyUpdate(Request $request)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Sorry !! You are not permitted to apply job !!');
            return back();
        }

        $this->validate($request, [
            'job_id' => 'required|numeric',
            'cover_letter' => 'required',
            'expected_salary' => 'nullable|numeric',
            'cv_file' => 'nullable|mimes:pdf|max:2000'
        ]);

        $jobActivity = JobActivity::where('user_id', Auth::id())->where('job_id', $request->job_id)->first();

        if ($jobActivity->user_id != Auth::id()) {
            session()->flash('error', 'Sorry !! You are not authenticated to update the application !!');
            return back();
        }

        $jobActivity->cover_letter = $request->cover_letter;

        if (isset($request->is_salary_negotiable)) {
            $jobActivity->is_salary_negotiable = 1;
            $jobActivity->expected_salary = 0;
        } else {
            $jobActivity->is_salary_negotiable = 0;
            $jobActivity->expected_salary = $request->expected_salary;
        }

        if (isset($request->use_profile_cv)) {
            if (Auth::user()->candidate->cv != null) {
                $cv = Auth::user()->candidate->cv;
            } else {
                $cv = NULL;
            }
        } else {
            // If there is any uploaded CV

            // Delete the existing File
            if (file_exists($jobActivity->cv)) {
                unlink($jobActivity->cv);
            }

            $cv_file = UploadHelper::upload('cv_file', $request->file('cv_file'), time(), 'public/files/cv');
            if (!is_null($cv_file)) {
                $cv = url('/') . '/public/files/cv/' . $cv_file;
            } else {
                $cv = NULL;
            }
        }
        $jobActivity->cv = $cv;
        $jobActivity->save();

        session()->flash('success', 'You have successfully updated the application !!');
        return redirect()->route('jobs');
    }
}
