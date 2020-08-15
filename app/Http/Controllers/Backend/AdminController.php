<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AdminAccountCreateNotification;
use App\Helpers\ImageUploadHelper;
use App\Helpers\StringHelper;
use App\Models\Admin;
use Hash;

class AdminController extends Controller
{
  public function __construct(){
    $this->middleware('auth:admin', ['except' => ['activateAccount']]);
  }

  /*
  Admin List
   */
  public function index()
  {
    $admins = Admin::orderBy('id', 'DESC')->get();
    return view('backend.pages.admin.index', compact('admins'));
  }

  /*
  Add admin form
   */
  public function create()
  {
    return view('backend.pages.admin.add');
  }

  /*
  Save admin
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'first_name' => 'required',
      'email' => 'required|unique:admins',
      'phone_no' => 'required|unique:admins'
    ]);

    $verifyToken = str_random(16);
    $password = str_random(8);
    $admin = new Admin;
    $admin->first_name = $request->first_name;
    $admin->last_name = $request->last_name;
    $admin->email = $request->email;
    $admin->phone_no = $request->phone_no;
    $admin->password = Hash::make($password);
    $admin->image = ImageUploadHelper::upload('image', $request->file('image'), time(), 'public/website-images/admins');
    $admin->username = StringHelper::createSlug($request->first_name, 'Admin', 'username');
    $admin->address = $request->address;
    $admin->verify_token = $verifyToken;
    $admin->save();

    // mail to admin
    $admin->notify(new AdminAccountCreateNotification($admin, $password, $verifyToken));

    session()->flash('success', 'An Email has been sent to this admin with password for verification');
    return redirect()->route('admin.account.index');
  }

  /*
  Activate account
   */
  public function activateAccount($verifyToken)
  {
      $admin = Admin::where('verify_token', $verifyToken)->update(['verify_token' => 1]);
      session()->flash('login_error', 'Account Activated Successfully');
      return redirect()->route('admin.login');
  }


  public function show($userName)
  {
    //
  }

  /*
  Edit admin account form
   */
  public function edit($userName)
  {
    $admin = Admin::where('username', $userName)->first();
    if($admin){
      return view('backend.pages.admin.edit', compact('admin'));
    }
    else{
      return redirect()->route('admin.account.index');
    }
  }

  /*
  Update admin account
   */
  public function update(Request $request, $userName)
  {
    $admin = Admin::where('username', $userName)->first();

    if($admin){
      $this->validate($request, [
        'first_name' => 'required',
        'email' => 'required|unique:admins,email,'.$admin->id,
        'phone_no' => 'required|unique:admins,phone_no,'.$admin->id,
        'username' => 'required|unique:admins,username,'.$admin->id
      ]);

      $admin->first_name = $request->first_name;
      $admin->last_name = $request->last_name;
      $admin->email = $request->email;
      $admin->phone_no = $request->phone_no;
      if($request->image){
        if($admin->iamge){
          $admin->image = ImageUploadHelper::update('image', $request->file('image'), time(), 'public/website-images/admins', $admin->image);
        }
        else{
          $admin->image = ImageUploadHelper::upload('image', $request->file('image'), time(), 'public/website-images/admins');
        }
      }
      $admin->username = StringHelper::createSlug($request->username, 'Admin', 'username');
      $admin->address = $request->address;
      $admin->save();

      session()->flash('success', 'Admin account updated Successfully');
      return redirect()->route('admin.account.index');
    }
    else{
      return back();
    }
  }

  /*
  Delete admin
   */
  public function destroy($userName)
  {
    $admin = Admin::where('username', $userName)->first();
    if($admin){
      if($admin->image){
        ImageUploadHelper::delete('public/website-images/admins/'.$admin->image);
      }

      $admin->delete();

      session()->flash('success', 'Admin deleted successfully');
      return redirect()->route('admin.account.index');
    }
    else{
      return back();
    }
  }
}
