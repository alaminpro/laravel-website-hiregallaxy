<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactUsController extends Controller
{
  public function __construct(){
    $this->middleware('auth:admin');
  }

  /*
  All contact message
   */
  public function index()
  {
    $messages = Contact::orderBy('is_seen', 'ASC')->get();
    return view('backend.pages.message.index', compact('messages'));
  }

  /*
   Details of individual Contact
   */
  public function details($id)
  {
    $message = Contact::find($id);
    if($message){
      $message->is_seen = 1;
      $message->save();

      return view('backend.pages.message.details', compact('message'));
    }
    else{
      return redirect()->route('admin.message.index');
    }
  }

  /*
  Contact delete
   */
  public function delete($id)
  {
    Contact::find($id)->delete();

    session()->flash('success', 'Message has been deleted successfully');
    return redirect()->route('admin.message.index');
  }
}
