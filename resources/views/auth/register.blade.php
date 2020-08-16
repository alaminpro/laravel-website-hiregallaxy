@extends('frontend.layouts.master')

@section('title')
Sign Up | Hire Gallaxy 
@endsection


@section('stylesheets')

@php
    $is_employer = false;
    if (isset($_GET['type']) &&  $_GET['type'] == 'employer') {
        $is_employer = true;
    }
@endphp
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="registration-form border p-2 m-3 pb-4" id="registration">
                <div class="strike">
                    <span class="text-yellow">Choose Account Type</span>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{ !$is_employer? 'active' : '' }}" id="pills-candidate-tab" data-toggle="pill" href="#pills-candidate" role="tab" aria-controls="pills-candidate" aria-selected="true">
                                            <i class="fa fa-user-o"></i>
                                            <br>
                                            Candidate
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{ $is_employer? 'active' : '' }}" id="pills-employer-tab" data-toggle="pill" href="#pills-employer" role="tab" aria-controls="pills-employer" aria-selected="false">
                                            <i class="fa fa-building-o"></i>
                                            <br>
                                            Employer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    @include('frontend.partials.messages')

                    <div class="tab-pane fade  {{ !$is_employer? 'show active' : '' }}" id="pills-candidate" role="tabpanel" aria-labelledby="pills-home-tab">

                        <form action="{{ route('register') }}" method="post" data-parsley-validate>
                            @csrf

                            <input type="hidden" name="is_company" value="0">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="name">Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Write Your Name" required  value="{{ old('name') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="username">Username <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Write Your Username" required  value="{{ old('username') }}" data-parsley-type="alphanum">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="email">Email Address <span class="required">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Write Your Email Address" required  value="{{ old('email') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="sector">Position <span class="required">*</span></label>
                                    <select name="sector" id="sector" class="form-control" required value="{{ old('sector') }}">
                                        <option value="">Select One</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('sector') == $cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="street_address">Street Address <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="street_address" id="street_address" placeholder="Write Your Address" required  value="{{ old('street_address') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="country">Your City <span class="required">*</span></label>
                                    <select name="country" id="country" class="form-control" required value="{{ old('country') }}">
                                        <option value="">Select a city</option>
                                        @foreach (App\Models\State::orderBy('name', 'asc')->get() as $state)
                    					<option value="" disabled style="font-weight: bolder;font-size: 16px;">
                    						{{ $state->name }}
                    					</option>
                    					@foreach ($state->cities()->orderBy('name', 'asc')->get() as $country)
                    					<option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected':'' }}>
                    						&nbsp; &nbsp;
                    						{{ $country->name }}
                    					</option>
                    					@endforeach
                    					@endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="password">Password <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password" id="passwordCandidate" minlength="8" placeholder="Write A Strong Password"  required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Write Password Again" data-parsley-equalto="#passwordCandidate"  minlength="8" required>
                                </div>
                            </div>
	<div class="form-group">
		<div class="form-check">
			<input class="form-check-input" type="checkbox" id="employerSendMessage" checked>
			<label class="form-check-label ml-3" for="employerSendMessage">
				Accept our <a href="{{ route('terms') }}" class="text-yellow">Terms and Condition</a> and <a href="{{ route('privacy') }}"  class="text-yellow">Privacy Policy</a>
			</label>
		</div>
	</div>

                            <div class="row justify-content-center form-group text-center">
                                <div class="col-8">
                                    <input type="submit" value="Sign Up" class="btn btn-block apply-now-button pt-2 pb-2 font20 ">
                                    <div class="mt-3 mb-3">
                                        <div class="text-center text-theme font16">
                                            Already have an account ?
                                            <a href="#signInModal" data-toggle="modal" class="text-yellow">Log in</a>
                                        </div>
                                    </div>

                                    {{-- <div class="mt-1">
                                        <div class="strike">
                                            <span class="text-yellow">Or</span>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            {{-- <div>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="" class="social-login facebook">
                                            <i class="fa fa-facebook"></i>
                                            <span class="text">
                                                Login With Facebook
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="" class="social-login twitter">
                                            <i class="fa fa-twitter"></i>
                                            <span class="text">
                                                Login With Twitter
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <a href="" class="social-login google-plus">
                                            <i class="fa fa-google-plus"></i>
                                            <span class="text">
                                                Login With Google
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <a href="" class="social-login linkedin">
                                            <i class="fa fa-linkedin"></i>
                                            <span class="text">
                                                Login With Linkedin
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div> --}}

                        </form>
                    </div>
                    <div class="tab-pane fade {{ $is_employer? 'show active' : '' }}" id="pills-employer" role="tabpanel" aria-labelledby="pills-employer-tab">

                        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            <input type="hidden" name="is_company" value="1">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="name">Company/Employer Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Write Name" required  value="{{ old('name') }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="username">Username <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Write Your Username" required  value="{{ old('username') }}" data-parsley-type="alphanum">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="email">Email Address <span class="required">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Write Your Email Address" required  value="{{ old('email') }}">
                                </div>
{{-- 
                                <div class="col-md-6">
                                    <label for="website"> Website <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="website" id="website" placeholder="www.example.com">
                                </div> --}}
                                <div class="col-md-6">
                                    <label for="sector">Position <span class="required">*</span></label>
                                    <select name="sector" id="sector" class="form-control" required>
                                        <option value="">Select One</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('sector') == $cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="street_address">Street Address <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="street_address" id="street_address" placeholder="Write Your Address" required value="{{ old('street_address') }}" value="{{ old('street_address') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="country">Your City <span class="required">*</span></label>
                                    <select name="country" id="country" class="form-control" required>
                                        <option value="">Select a city</option>
                                        @foreach (App\Models\State::orderBy('name', 'asc')->get() as $state)
                    					<option value="" disabled style="font-weight: bolder;font-size: 16px;">
                    						{{ $state->name }}
                    					</option>
                    					@foreach ($state->cities()->orderBy('name', 'asc')->get() as $country)
                    					<option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected':'' }}>
                    						&nbsp; &nbsp;
                    						{{ $country->name }}
                    					</option>
                    					@endforeach
                    					@endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="password">Password <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password" id="passwordEm" placeholder="Write A Strong Password" maxlength="8" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Write Password Again" maxlength="8" data-parsley-equalto="#passwordEm" required>
                                </div>
                            </div>
                            	<div class="form-group">
	


                         
                                <div class="col-8">
                                    <a href="#signInModal" data-toggle="modal" class="text-yellow">Log in</a>
                                    <input type="submit" value="Sign Up" class="btn btn-block apply-now-button pt-2 pb-2 font20 ">
                                    <div class="mt-3 mb-3">
                                        <div class="text-center text-theme font16">
                                            Already have an account ?
                                            <a href="#signInModal" data-toggle="modal" class="text-yellow">Log in</a>
                                        </div>
                                    </div>

                                    {{-- <div class="mt-1">
                                        <div class="strike">
                                            <span class="text-yellow">Or</span>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            {{-- <div>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="" class="social-login facebook">
                                            <i class="fa fa-facebook"></i>
                                            <span class="text">
                                                Login With Facebook
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="" class="social-login twitter">
                                            <i class="fa fa-twitter"></i>
                                            <span class="text">
                                                Login With Twitter
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <a href="" class="social-login google-plus">
                                            <i class="fa fa-google-plus"></i>
                                            <span class="text">
                                                Login With Google
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <a href="" class="social-login linkedin">
                                            <i class="fa fa-linkedin"></i>
                                            <span class="text">
                                                Login With Linkedin
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div> --}}

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

@endsection