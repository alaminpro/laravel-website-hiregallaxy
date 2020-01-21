@extends('frontend.layouts.master')

@section('title')
Candidate Dashboard | {{ App\Models\Setting::first()->site_title }}
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
									onclick="location.href='{{ route('candidates.jobs.applied') }}'">
									<i class="fa fa-bell font30"></i>
									<h6>
										{{ count($user->jobApplications) }} Jobs
									</h6>
									<p>
										Applied
									</p>
								</div>
							</div>

							<div class="col-md-4">
								<div class="single-dashboard-link card card-default p-3 text-center"
									onclick="location.href='{{ route('candidates.jobs.favorite') }}'">
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
									onclick="location.href='{{ route('candidates.messages') }}'">
									<i class="fa fa-envelope font30"></i>
									<h6>
										@php
									        $messages = count($user->received_messages()->where('is_seen', 0)->get());
									    @endphp
										{{ $messages }} Message{{ $messages > 1 ? 's' : '' }}
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
									onclick="location.href='{{ route('candidates.show', $user->username) }}'">
									<i class="fa fa-edit font30"></i>
									<h6>
										Profile
									</h6>
									<p>
										Edit
									</p>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
			<div class="col-md-4">
				@include('frontend.pages.partials.candidates-sidebar')
			</div>
		</div>
</section>
@endsection


@section('scripts')

@endsection