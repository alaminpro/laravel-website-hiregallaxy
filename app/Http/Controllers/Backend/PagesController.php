<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Job;
use App\Models\CandidateProfile;
use App\Models\CompanyProfile;
use App\Models\Category;
use App\Models\Country;
use App\Models\Skill;
use App\Models\Experience;
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
    $jobs = count(Job::all());
    $categories = count(Category::all());
    $skills = count(Skill::all());
    $experiences = count(Experience::all());
    $employers = count(CompanyProfile::all());
    $candidates = count(CandidateProfile::all());
    $templates = count(Template::all());
    $cities = count(Country::all());
    $crawlers = count(WebCrawler::all());
    return view('backend.pages.index', compact('jobs', 'categories', 'employers', 'candidates', 'skills', 'experiences', 'templates', 'cities', 'crawlers'));
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
