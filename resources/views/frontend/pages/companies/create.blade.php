@extends('frontend.layouts.master') 

@section('title')

Create new Company | {{ App\Models\Setting::first()->site_title }}

@endsection
 
@section('stylesheets')



@endsection 

@section('content')

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-12">



				<h3 class="top-title wow fadeInUp mb-3">
Create new company 

				</h3>  

				<div class="navbar-breadcrumb  d-flex justify-content-between align-items-center">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('employers.dashboard') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">create new</li>

					</ol>
                    <a href="{{ route('employers.dashboard') }}" class="btn btn-dark">Back</a>
				</div>

			</div>

		</div>

	</div>

</div>
<section class="employer-page sec-pad pt-4" id="wrapper"> 
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-body">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  
                      <div class="card mb-3"> 
                        <div class="card-header py-3"> 
                          <div class="float-left"> 
                            <h6 class="m-0 font-weight-bold text-primary">Companies</h6> 
                          </div> 
                          <div class="float-right"> 
                            <a href="{{ route('companies') }}" class="btn btn-sm btn-success shadow-sm"><i class="fa fa-arrow-left fa-sm text-white-50"></i> Back</a> 
                          </div> 
                          <div class="clearfix"></div> 
                        </div> 
                            <div class="card-body"> 
                            @include('backend.partials.message') 
                            <form action="{{ route('company.store') }}" method="post">

                                @csrf
     
                                <div class="form-group">
                                    <label for="assign_id">Assigned <span class="required">*</span></label> 
                                    <select name="assign_id" id="assign_id" class="form-control" value="{{ old('assign_id') }}"> 
                                        <option value="">Select a team</option> 
                                        @foreach ($users as $user) 
                                        <option value="{{ $user->id }}"> 
                                            {{ $user->name }} 
                                        </option>  
                                        @endforeach 
                                    </select> 
                                    @if (!count($users) > 0)
                                        Please add team first!
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Company Name <span class="required">*</span></label> 
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Write Your Company Name" required  value="{{ old('name') }}"> 
                                </div>
                                <div class="form-group">
                                    <label for="contact_person">Contact Person <span class="required">*</span></label> 
                                    <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Contact Person Name" required  value="{{ old('contact_person') }}"> 
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address <span class="required">*</span></label> 
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Write Your Email Address" required  value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="location">Location </label> 
                                    <select name="location" id="location" class="form-control" value="{{ old('location') }}"> 
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
                                    <label for="phone">Contact Number </label> 
                                    <input type="number" class="form-control" name="phone" id="phone"   value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                    <label for="website_url">Website Url </label> 
                                    <input type="url" class="form-control" name="website_url" id="website_url" value="{{ old('website_url') }}">
                                </div> 
                                <div class="form-group"> 
                                        <input type="submit" class="btn btn-success" value="Submit">
                                </div> 
                            </form>
                                
                            </div>  
                        </div><!-- end card--> 
                      </div> 
                    </div>  
                  </div>
            </div>
        </div>
    </div>

</section>

@endsection 

@section('scripts')



@endsection