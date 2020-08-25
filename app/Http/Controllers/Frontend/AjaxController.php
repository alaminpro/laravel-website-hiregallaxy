<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CandidateProfile;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobActivity;
use App\Models\UserQualification;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function main(Request $request)
    {
        if ($this->request->has('action')) {
            $action = $this->request->get('action');
            if (method_exists($this, $action)) {
                return $this->$action();
            }
        }
        return response()->json(['status' => 'error`']);
    }

    public function posted_job()
    {
        $user = Auth::user();
        $title = 'Total Posted Jobs';
        $id = null;
        if ($this->request->id) {
            if ($this->request->id == auth()->user()->id) {
                $user = User::where('type', 1)->where('id', auth()->user()->id)->first();
                $id = $this->request->id;
            } else {
                $id = $this->request->id;
                $user = User::where('type', 1)->where('id', $this->request->id)->first();
            }
        }

        $user_id = $user->id;

        $_filter = request()->filter ?? null;

        $jobs = Job::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();

        $user_jobs = $user->jobs;

        $user_jobs_count = $user_jobs->count();

        $user_active_jobs_count = $user_jobs->where('archived', 0)->count();
        $user_inactive_jobs_count = $user_jobs->where('archived', 1)->count();

        $html = view('frontend.pages.ajax-load.employers.posted-job-load', compact('title', 'id', 'user', 'jobs', 'user_jobs_count', 'user_active_jobs_count', 'user_inactive_jobs_count'))->render();
        return response()->json(['status' => 'success', 'html' => $html]);
    }

    public function job_status_show()
    {
        $status = $this->request->status;
        if (!Auth::check()) {

            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');

            return redirect()->route('index');

        }
        $title = "";
        $user = Auth::user();
        if ($this->request->id) {
            if ($this->request->id == auth()->user()->id) {
                $user = User::where('type', 1)->where('id', auth()->user()->id)->first();
            } else {
                $user = User::where('type', 1)->where('id', $this->request->id)->first();
            }
        }
        $user_id = $user->id;

        if ($status == 'Live') {
            $title = "Total Live Jobs";
            $timezone = date_default_timezone_get();

            $date = date('Y/m/d H:i:s');

            $jobs = \App\Models\Job::where('user_id', $user->id)->orderBy('created_at', 'DESC')->where('deadline', '>', $date)->get();

        } elseif ($status == 'In-progress') {
            $title = "Total In-progress Jobs";
            $timezone = date_default_timezone_get();

            $date = date('Y/m/d H:i:s');

            $jobs = \App\Models\Job::where('user_id', $user->id)->orderBy('created_at', 'DESC')->where('deadline', '<', $date)->where('archived', 0)->get();

        } elseif ($status == 'Archived') {
            $title = "Total  Archived Jobs";
            $timezone = date_default_timezone_get();

            $date = date('Y/m/d H:i:s');

            $jobs = \App\Models\Job::where('user_id', $user->id)->orderBy('created_at', 'DESC')->where('archived', 1)->get();

        } else {

            $jobs = \App\Models\Job::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        }

        $html = view('frontend.pages.ajax-load.employers.live-job-load', compact('user', 'title', 'jobs', 'status'))->render();
        return response()->json(['status' => 'success', 'html' => $html]);

    }

    public function all_activity()
    {
        $user = Auth::user();
        if ($this->request->id) {
            if ($this->request->id == auth()->user()->id) {
                $user = User::where('type', 1)->where('id', auth()->user()->id)->first();
            } else {
                $user = User::where('type', 1)->where('id', $this->request->id)->first();
            }
        }
        $user_id = $user->id;

        $applicant = DB::table('job_activities')->where('user_id', $user_id)->get();

        $job = Job::where('slug', $this->request->slug)->first();

        // Filter application

        $expreience_data = Experience::all();

        $filter = [];

        $query = JobActivity::query();

        if (isset(request()->date_from) && isset(request()->date_to)) {

            $query->whereDate('created_at', '>=', request()->date_from);

            $query->whereDate('created_at', '<=', request()->date_to);

            $filter['date_from'] = request()->date_from;

            $filter['date_to'] = request()->date_to;

        }

        if (isset(request()->salary_from) && isset(request()->salary_to)) {

            $query->where('expected_salary', '>=', request()->salary_from);

            $query->where('expected_salary', '<=', request()->salary_to);

            $filter['salary_from'] = request()->salary_from;

            $filter['salary_to'] = request()->salary_to;

        }

        //$applications = $query->where('job_id', $job->id)->get();

        $applications = JobActivity::where('job_id', $job->id)->get();

        $experiences = [];

        $education = [];

        $application_data = [];

        foreach ($applications as $application) {

            // Filter

            if (isset(request()->exp)) {

                $exp_data = CandidateProfile::with('experience')->where('experience_id', request()->exp)->where('user_id', $application->user_id)->first();

                if ($exp_data) {

                    $experiences[] = $exp_data;

                    $education[] = UserQualification::where('user_id', $application->user_id)->first();

                    $application_data[] = $application;

                    $filter['exp'] = request()->exp;

                }

            } else {

                $experiences[] = CandidateProfile::with('experience')->where('user_id', $application->user_id)->first();

                $education[] = UserQualification::where('user_id', $application->user_id)->first();

                $application_data[] = $application;

            }

        }

        $education = $education ? $education[0] : [];

        $experience = $experiences ? $experiences[0] : [];

        // return $applications;

        $applications = $application_data;

        //dd($applications);

        // Export data

        if (request()->has('export')) {

            $export = new \App\Exports\JobApplicationExport($job, $applications);

            return \Excel::download($export, $job->slug . '_' . time() . '.xlsx');

        }

        // Delete applicant

        if (request()->has('delete')) {
            DB::table('job_activities')->where('id', $applicant->id)->delete();
            session()->flash('success', 'Applicant deleted successfully !!');
        }

        $html = view('frontend.pages.ajax-load.employers.job-application-load', compact('user', 'applicant', 'job', 'applications', 'experience', 'education', 'filter', 'expreience_data'))->render();
        return response()->json(['status' => 'success', 'html' => $html]);
    }

    public function job_activity()
    {

        if (!Auth::check()) {

            session()->flash('error', 'Sorry !! You are not an authenticated Employer !!');

            return redirect()->route('index');

        }

        $user = Auth::user();
        if ($this->request->id) {
            if ($this->request->id == auth()->user()->id) {
                $user = User::where('type', 1)->where('id', auth()->user()->id)->first();
            } else {
                $user = User::where('type', 1)->where('id', $this->request->id)->first();
            }
        }
        $user_id = $user->id;
        $job = Job::where('slug', $this->request->slug)->first();
        if ($this->request->status) {
            $status = $this->request->status;
            $slug = $this->request->slug;
            $applicant = JobActivity::where('status', $this->request->status)->where('company_id', $user_id)->where('job_id', $job->id)->get();
            $html = view('frontend.pages.ajax-load.employers.listed-job-load', compact('user', 'applicant', 'status', 'slug'))->render();
            return response()->json(['status' => 'success', 'html' => $html]);
        }
        return response()->json(['status' => 'error']);

    }
}
