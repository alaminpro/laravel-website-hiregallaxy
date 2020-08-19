@extends('frontend.layouts.master')



@section('title')

Employer Dashboard | {{ App\Models\Setting::first()->site_title }}

@endsection



@section('stylesheets')



@endsection



@section('content')

<section class="employer-page sec-pad pt-0" id="wrapper">

	<div class="container">

		<div class="row">
	
			<div class="col-md-6">
				<div class="employer-detail-main">

					<div class="mt-2 mr-0 mr-sm-2">

						<h5 class="text-theme p-2  text-capitalize">{{ auth()->user()->type == 1? 'Your' : $user->username }} Statistics</h5>

						<div class="row">

							<div class="col-sm-6 col-md-6 col-lg-4 mb-2 px-1">

								<div class="single-dashboard-link card card-default p-3 text-center"

									onclick="location.href='{{ route('employers.jobs.posted') }}'">

									<i class="fa fa-bell font30"></i>

									<h6>

										{{ count($user->jobs) }} Jobs

									</h6>

									<p>

										Posted

									</p>

								</div>

							</div> 

						</div>

					</div>

				</div>

			</div>


			<div class="col-md-6">

				<div class="mt-2 ml-0 ml-sm-3">

					<h5 class="text-theme p-2 text-capitalize">{{ auth()->user()->type == 1? 'Your' : $user->username }} Profile</h5>

					<div class="row">

						<div class="col-sm-6 col-md-6 col-lg-4 mb-2 px-1">

							<div class="single-dashboard-link card card-default p-3 text-center"

								onclick="location.href='{{ route('team.show', $user->username) }}'">

								<i class="fa fa-edit font30"></i>

								<h6>

									Profile

								</h6>

								<p>

									Edit

								</p>

							</div>

						</div> 
						<div class="col-sm-6 col-md-6 col-lg-4 mb-2 px-1">

								<div class="single-dashboard-link card card-default p-3 text-center"

									onclick="location.href='{{ route('employers.search.candidates') }}'">

									<i class="fa fa-search font30"></i>

									<h6>

									 Search Candidates

									</h6> 

								</div>

						</div>  
				 
					</div>

				</div>
		
				<div class="mt-4 todo__team" data-id="{{ auth()->user()->type == 0 ? $user->id : '' }}">

					@include('frontend.pages.todo._component')

				</div>

			</div>

		</div>

	</div>
	 

</section>

@endsection





@section('scripts')



@endsection