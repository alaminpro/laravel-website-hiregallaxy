<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ImageUploadHelper;
use App\Helpers\StringHelper;
use App\Helpers\UploadHelper;
use App\Models\Setting;

class SettingsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /*
  Settings
   */
  public function index()
  {
    $settings = Setting::first();
    return view('backend.pages.settings.index', compact('settings'));
  }


  //   /*
  //   Settings save
  //   */
  //   public function store(Request $request)
  //   {
  //     $this->validate($request, [
  //       'company_name' => 'required',
  //       'website_logo' => 'required',
  //       'location' => 'required',
  //       'phone_no_1' => 'required',
  //       'phone_no_2' => 'required',
  //       'like_vote_value' => 'required'
  //     ]);

  //     $settings = new Setting();
  //     $settings->company_name = $request->company_name;
  //     $settings->location = $request->location;
  //     $settings->phone_no_1 = $request->phone_no_1;
  //     $settings->phone_no_2 = $request->phone_no_2;
  //     $settings->like_vote_value = $request->like_vote_value;
  //     $settings->website_logo = ImageUploadHelper::upload('website_logo', $request->file('website_logo'), time(), 'public/website-images/settings');
  //     $settings->save();

  //     session()->flash('success', 'Settings information added successfully');
  //     return redirect()->route('admin.settings.index');
  //   }

  /*
  Settings update
   */
  public function update(Request $request)
  {
    $this->validate($request, [
      'site_title' => 'required',
      'admin_theme' => 'required',
      'enable_job_editing' => 'required',
    ]);

    $settings = Setting::first();
    $settings->site_title = $request->site_title;
    $settings->admin_theme = $request->admin_theme;
    $settings->enable_job_editing = $request->enable_job_editing;
    $settings->terms_and_service = $request->terms_and_service;
    $settings->privacy_policy = $request->privacy_policy;

    // Logo + Favicon
    if ($request->site_logo) {
      $settings->site_logo = UploadHelper::update('site_logo', $request->file('site_logo'), time(), 'public/images', $settings->site_logo);
    }
    if ($request->site_favicon) {
      $settings->site_favicon = UploadHelper::update('site_favicon', $request->file('site_favicon'), time(), 'public/images', $settings->site_favicon);
    }
    $settings->save();

    session()->flash('success', 'Settings information updated successfully');
    return redirect()->route('admin.settings.index');
  }
}
