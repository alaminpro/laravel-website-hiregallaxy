@extends('frontend.layouts.master-two') 

@section('title')

Teams | {{ App\Models\Setting::first()->site_title }}

@endsection
 
@section('stylesheets')



@endsection 

@section('content')

<section class="employer-page sec-pad pt-4" id="wrapper"> 
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-body"> 
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> 
                        <form action="{{ route('team.store') }}" method="post">

                            @csrf

                            <div class="card mb-3"> 
                                <div class="card-header py-3"> 
                                <div class="float-left"> 
                                    <h6 class="m-0 font-weight-bold text-primary">New Teams</h6> 
                                </div> 
                                <div class="float-right"> 
                                    <a href="{{ route('teams') }}" class="btn btn-sm btn-success shadow-sm">Back</a> 
                                </div> 
                                <div class="clearfix"></div> 
                                </div> 
                                <div class="card-body"> 
                                    <div class="form-group">
                                        <label for="name">Name <span class="required">*</span></label> 
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Write Your Name" required  value="{{ old('name') }}"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address <span class="required">*</span></label> 
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Write Your Email Address" required  value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location<span class="required">*</span></label> 
                                        <select name="location" id="location" class="form-control" required value="{{ old('location') }}">
    
                                            <option value="">Select a Location</option>
    
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
                                    <div class="form-group">
                                        <label for="phone_no">Phone Number </label> 
                                        <input type="number" class="form-control" name="phone_no" id="phone_no"   value="{{ old('phone_no') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <span class="required">*</span></label> 
                                        <input type="password" class="form-control" name="password" id="passwordEm" placeholder="Write A Strong Password" maxlength="8" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                                          <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Write Password Again" maxlength="8"   required>
                                    </div>
                                    <div class="form-group"> 
                                          <input type="submit" class="btn btn-success" value="Submit">
                                    </div>
                                </div> 
                            </div><!-- end card-->
                        </form>
                    </div>
                  
                  </div>
            </div>
        </div>
    </div>

</section>

@endsection 

@section('scripts')



@endsection