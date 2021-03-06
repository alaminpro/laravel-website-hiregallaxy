<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Job;
use App\Models\CandidateProfile;
use App\Models\CompanyProfile;
use App\Models\Category;
use App\Models\Country;
use App\Models\Discipline;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Sector;
use App\Models\Segment;
use App\Models\Admin;
use Auth;
use Hash;
use App\Models\Template;
use App\Models\WebCrawler;

class PagesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /*
  Admin home page
  */
  public function index()
  {
    $jobs = count(Job::select('id')->get());
    $categories = count(Category::select('id')->get());
    $skills = count(Skill::select('id')->get());
    $experiences = count(Experience::select('id')->get());
    $employers = count(CompanyProfile::select('id')->get());
    $candidates = count(CandidateProfile::select('id')->get());
    $templates = count(Template::select('id')->get());
    $cities = count(Country::select('id')->get());
    $crawlers = count(WebCrawler::select('id')->get());
    $disciplines = count(Discipline::select('id')->get());
    $segments = count(Segment::select('id')->get());
    $sectors = count(Sector::select('id')->get());
    $admins = count(Admin::select('id')->get());
    return view('backend.pages.index', compact('admins','jobs', 'categories', 'employers', 'candidates', 'skills', 'experiences', 'templates', 'cities', 'crawlers', 'disciplines', 'segments', 'sectors'));
  }


  /*
  Change password form
   */
  public function changePasswordForm()
  {
    return view('backend.pages.changePasswordForm');
  }


  /*
  Change password with matching old one
   */
  public function changePassword(Request $request)
  {
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required|confirmed',
      'password_confirmation' => 'required'
    ]);

    $admin = Auth::guard('admin')->user();
    $admin->password = Hash::make($request->password);
    $admin->email = $request->email;
    $admin->save();

    session()->flash('success', 'Password changed successfully');
    return back();

    // if (Hash::check($request->old_password, $admin->password)) {
    //   $admin->password = Hash::make($request->password);
    //   $admin->save();

    //   session()->flash('success', 'Password changed successfully');
    //   return back();
    // } else {
    //   session()->flash('error', 'Old password does not match');
    //   return back();
    // }
  }
}
