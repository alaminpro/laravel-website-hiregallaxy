@extends('frontend.layouts.master')

@section('title')
Employer Dashboard | {{ App\Models\Setting::first()->site_title }}
@endsection

@section('stylesheets')

@endsection

@section('content')
<section class="employer-page sec-pad pt-0">
	<div class="container">
		<div class="row mt-4">
			<div class="col-md-8">
				<div class="employer-detail-main">
					<h5 class="text-theme">
						Welcome {{ $user->name }}
					</h5>
					<p>
						You can manage/see your informations from this section.
					</p>
					<hr>
					<div class="mt-2">
						<h5 class="text-theme p-2">Your Statistics</h5>
						<div class="row">
							<div class="col-md-4">
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

							<div class="col-md-4">
								<div class="single-dashboard-link card card-default p-3 text-center"
									onclick="location.href='{{ route('employers.jobs.favorite') }}'">
									<i class="fa fa-heart font30"></i>
									<h6>
										{{ count($user->favoriteJobs) }} Jobs
									</h6>
									<p>
										Favorite
									</p>
								</div>
							</div>

							<div class="col-md-4">
								<div class="single-dashboard-link card card-default p-3 text-center"
									onclick="location.href='{{ route('employers.messages') }}'">
									<i class="fa fa-envelope font30"></i>
									<h6>
										{{ count($user->received_messages()->where('is_seen',0)) }} Message
									</h6>
									<p>
										Total
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="mt-3">
						<h5 class="text-theme p-2">Your Profile</h5>
						<div class="row">
							<div class="col-md-4">
								<div class="single-dashboard-link card card-default p-3 text-center"
									onclick="location.href='{{ route('employers.show', $user->username) }}'">
									<i class="fa fa-edit font30"></i>
									<h6>
										Profile
									</h6>
									<p>
										Edit
									</p>
								</div>
							</div>

							<div class="col-md-4">
								<div class="single-dashboard-link card card-default p-3 text-center"
									onclick="location.href='{{ route('jobs.post') }}'">
									<i class="fa fa-plus-circle font30"></i>
									<h6>
										Post
									</h6>
									<p>
										New Job
									</p>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
			<div class="col-md-4">
				@include('frontend.pages.partials.employers-sidebar')
			</div>
		</div>
</section>
@endsection


@section('scripts')

@endsection