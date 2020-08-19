<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Location;
use App\Models\UserTeam;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->is_company == 1) {
            $users = User::where('type', 1)
                ->whereHas('team', function ($query) {
                    $query->where('employer_id', auth()->user()->id);
                })
                ->with(['location' => function ($q) {
                    $q->select('id', 'country_id');
                }])
                ->select('id', 'name', 'email', 'phone_no', 'location_id')
                ->get();
            return view('frontend.pages.teams.teams', compact('users'));
        } else {
            return redirect()->back()->with('errors', 'Permission denied');
        }
    }
    /**
     * Display dashboard element
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard($id = null)
    {
        if (auth()->check()) {
            if ($id) {
                $check = User::where('id', auth()->user()->id)->where('type', 0)->first();
                if ($check) {
                    $user = User::where('type', 1)->where('id', $id)->select('id', 'name', 'username', 'email')->first();
                } else {
                    return redirect()->route('team.dashboard');
                }
            } else {
                $user = User::where('type', 1)->where('id', auth()->user()->id)->select('id', 'name', 'username', 'email')->first();
            }
            if ($user) {

                return view('frontend.pages.teams.dashboard', compact('user'));
            } else {
                return redirect()->route('index');
            }
        }
        return redirect()->route('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.pages.teams.team-create');
    }

    public function showProfile($username)
    {

        $user = User::where('type', 1)->where('username', $username)->first();

        if (is_null($user)) {

            session()->flash('error', 'No Team has been found !!');

            return redirect()->route('team.dashboard');

        }
        return view('frontend.pages.teams.show', compact('user'));

    }
    public function updateProfile(Request $request, $user_id)
    {

        if (!Auth::check() && Auth::id() != $user_id) {

            session()->flash('error', 'Sorry !! You are not permitted to do this action');

            return back();

        }

        $this->validate($request, [

            'name' => 'required|max:30',

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

            'establish_date' => $request->establish_date,

            'establish_year' => substr($request->establish_date, 0, 4),

            'team_member' => $request->team_member,

        ]);

        session()->flash('success', 'Your profile information has been updated !!');

        return back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'location' => 'required',
            'password' => 'required|min:8|confirmed',
        ],

            [

                'location.required' => 'Please choose your Location',

                'email.required' => 'Please give an email address',

                'email.email' => 'Please give a valid email address',

                'email.unique' => 'Sorry !! An email is already exists',

                'name.required' => 'Please give your name',

                'name.max' => 'Please give your name between 30 characters',

                'password.min' => 'Please give your password more than 8 characters',

                'password.confirmed' => 'Please confirm your password',

            ]

        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Create location and add location ID

        if (auth()->check() && auth()->user()->is_company == 1) {
            $location = new Location();
            $location->country_id = $request->location;
            $location->save();

            $user = new User();
            $user->name = $request->name;
            $user->username = $request->name . "-" . \Str::random(3);
            $user->email = $request->email;
            $user->phone_no = $request->phone_no;
            $user->location_id = $location->id;
            $user->status = 1;
            $user->is_company = 1;
            $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));
            $user->password = Hash::make($request->password);
            $user->type = 1;
            $user->save();

            $userteam = new UserTeam();
            $userteam->employer_id = auth()->user()->id;
            $userteam->user_id = $user->id;
            $userteam->save();

            $company = new CompanyProfile();

            $company->user_id = $user->id;

            $company->category_id = 85;

            $company->save();

            return redirect()->route('teams')->with('success', 'Profile created successfull');
        } else {
            return redirect()->back()->with('errors', 'Permission denied');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();

            return redirect()->back();
        }
    }
}
