@extends('frontend.layouts.master')

@section('title')
{{ App\Models\Setting::first()->site_title }} | HomePage
@endsection


@section('stylesheets')

@endsection


@section('content')

<!-- How Work Area -->
<section class="how-work sec-pad">
	<div class="container">
		<h3 class="how-work-title wow fadeInDown">How it Works</h3>
		<p class="how-work-description wow fadeInUp">Create account search for the job and got hired, just simple !!</p>

		<div class="row justify-content-center">
			<div class="col-md-10 mt-5">
				<div class="row">
					<div class="col-md-4 wow fadeInLeft">
						<img src="{{ asset('public/images/default/create-account.png') }}" class="how-work-image"
							alt="">
						<h4 class="how-work-subtitle">Create an account</h4>
						<p class="how-work-sub-description">
							Create an account with your valid information with all your skill and experience to get the
							companies attention at your
						</p>
					</div>
					<div class="col-md-4 wow fadeInDown">
						<img src="{{ asset('public/images/default/search-work.png') }}" class="how-work-image" alt="">
						<h4 class="how-work-subtitle">Search And Apply</h4>
						<p class="how-work-sub-description">
							Create an account with your valid information with all your skill and experience to get the
							companies attention at your
						</p>
					</div>
					<div class="col-md-4 wow fadeInRight">
						<img src="{{ asset('public/images/default/start-work.png') }}" class="how-work-image" alt="">
						<h4 class="how-work-subtitle">Start Work</h4>
						<p class="how-work-sub-description">
							Create an account with your valid information with all your skill and experience to get the
							companies attention at your
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- How Work Area -->

<!-- Popular Positions Area -->
<section class="popular-categories sec-pad">
	<div class="container">
		<h3 class="popular-title">Popular Positions</h3>
		<p class="poular-description">Apply any of those position and got hired immediately !!</p>

		<div class="row mt-3 justify-content-center">

			@foreach ($categories as $category)
			<div
				class="col-xsm-6 col-md-5th-1 {{ $loop->index % 5 == 0 ? 'col-md-offset-0 col-sm-offset-2' : '' }} text-center">
				<div class="single-category-item pointer"
					onclick="location.href='{{ route('jobs.categories.show', $category->slug) }}'">
					<i class="{{ $category->icon }}"></i>
					<h4 class="category-item-title">{{ $category->name }}</h4>
					<p class="text-mute">
						{{ App\Models\Category::totalOpenJobs($category->id) }} jobs
					</p>
				</div>
			</div> <!-- Single Item -->
			@endforeach
		</div>
	</div>
</section>
<!-- Popular Positions Area -->



<!-- Featured And All Jobs -->
<section class="jobs sec-pad">
	<div class="container">

		<div class="row justify-content-center">
			<div class="col-md-4 mt-1">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="featured-jobs-tab" data-toggle="tab" href="#featured-jobs"
							role="tab" aria-controls="featured-jobs" aria-selected="true">Featured Jobs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="recent-jobs-tab" data-toggle="tab" href="#recent-jobs" role="tab"
							aria-controls="recent-jobs" aria-selected="false">Recent Jobs</a>
					</li>
				</ul>
			</div>
		</div>


		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="featured-jobs" role="tabpanel"
				aria-labelledby="featured-jobs-tab">
				<div class="row mt-4">

					@foreach ($featured_jobs as $single_job)
					<div class="col-md-6">
						@include('frontend.pages.partials.single-job-search')
					</div><!-- End Single Item -->
					@endforeach

				</div>
			</div>
			<div class="tab-pane fade" id="recent-jobs" role="tabpanel" aria-labelledby="recent-jobs-tab">
				<div class="row mt-4">
					@foreach ($recent_jobs as $single_job)
					<div class="col-md-6">
						@include('frontend.pages.partials.single-job-search')
					</div><!-- End Single Item -->
					@endforeach

				</div>
			</div>
		</div>


	</div>
</section>
<!-- Featured And All Jobs -->


<!-- Client Review Section -->
<section class="client-review sec-pad">
	<div class="container">
		<h3 class="client-review-title">Great Words From Happy Clients</h3>
		@if (Auth::check())
		<div class="float-right">
			<add-review-component url="{{ url('/') }}" api_token="{{ Auth::user()->api_token }}"
				is_company="{{ Auth::user()->is_company }}"></add-review-component>
		</div>
		@endif

		<p class="client-review-description mb-5">Lets See what’s our valuable candidates and employers saying about us
		</p>

		<div class="owl-carousel owl-theme">

			@foreach ($reviews as $review)
			<div class="wow fadeInLeft single-carousel-item item mt-3">
				<div class="float-left">
					<img src="{{ asset('public/images/users/'.$review->profile_picture) }}" class="client-image">
				</div>
				<div class="client-detail float-left ml-3 mb-2 ">
					<h4>{{ $review->name }}</h4>
					<p>{{ $review->position }}</p>
					<p>
						<a href="{{ $review->facebook_link }}" class="ml-2 text-white">
							<i class="fa fa-facebook"></i>
						</a>
						<a href="{{ $review->twitter_link }}" class="ml-2 text-white">
							<i class="fa fa-twitter"></i>
						</a>
						<a href="{{ $review->linkedin_link }}" class="ml-2 text-white">
							<i class="fa fa-linkedin"></i>
						</a>
					</p>
				</div>
				<div class="clearfix"></div>

				<div class="arrow-up"></div>
				<div class="speech">
					<blockquote cite="">
						{{ $review->review }}
					</blockquote>
				</div>
			</div> <!-- End Single Item -->
			@endforeach

		</div>
	</div>
</section>
<!-- Client Review Section -->


<!-- Create account -->
<section class="create-account sec-pad">
	<div class="container">
		<div class="text-center mb-5">
			<i class="fa fa-users hi-icon" aria-hidden="true"></i>
			<h4 class="hi-title">Hi There !</h4>
			<div class="row justify-content-center">
				<div class="col-md-8">
					<p>
						A systematic escape, the and for really we've in suppose client small to rationally be he
						feedback to luxury. Attempt, liabilities of nice, to counter. One effectiveness steps ages
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="create-account-part wow fadeInLeft">
					<h5>I'm</h5>
					<h3>Employee</h3>
					<p>
						A systematic escape, the and for really we've in suppose client small to rationally be he
						feedback to luxury. Attempt, liabilities of nice, to counter. One effectiveness steps ages
					</p>
					<p>
						<a href="{{ route('register') }}?type=candidate#registration"
							class="btn apply-now-button button-lg">Register as Candidate</a>
					</p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="create-account-part wow fadeInRight">
					<h5>I'm</h5>
					<h3>Company</h3>
					<p>
						A systematic escape, the and for really we've in suppose client small to rationally be he
						feedback to luxury. Attempt, liabilities of nice, to counter. One effectiveness steps ages
					</p>
					<p>
						<a href="{{ route('register') }}?type=employer#registration"
							class="btn apply-now-button button-lg">Register as Company</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Create account -->


<!-- Package -->
<section class="create-account sec-pad">

	<div class="container">
		<div class="text-center mb-5">
			<h4 class="hi-title">Our Packages</h4>
			<div class="row justify-content-center mb-5">
				<div class="col-md-8">
					<p>
						Apply any of those category wise job and get hired immediately
					</p>
				</div>
			</div>

			<div class="text-center">
				<div class="row">

					<div class="col-md-4">
						<div class="package-item wow fadeInLeft">
							<div class="header-package">
								<h6>Small Business</h6>
								<h4>Simple</h4>
							</div>
							<div>
								<div class="per-month">
									<span class="per-month-sign">$</span>
									<span class="per-month-amount">25</span>
									<span class="per-month-text">/Month</span>
								</div>
								<div class="package-links">
									<table class="package-link-table">
										<tbody>
											<tr>
												<td class="package-number">15</td>
												<td class="package-text">Job Posting</td>
											</tr>
											<tr>
												<td class="package-number">8</td>
												<td class="package-text">Featured Job</td>
											</tr>
											<tr>
												<td class="package-number">15</td>
												<td class="package-text">Renew Job</td>
											</tr>
											<tr>
												<td class="package-number">30</td>
												<td class="package-text">Days Duration</td>
											</tr>
											<tr>
												<td class="package-number">7</td>
												<td class="package-text">Category</td>
											</tr>
										</tbody>
									</table>

									<p class="mt-4 mb-4">
										<a href="{{ route('contacts') }}"
											class="btn btn-outline-info category-item-link btn-package">Buy Now</a>
									</p>
								</div>
							</div>
						</div>
					</div><!-- Package Single Item -->


					<div class="col-md-4">
						<div class="package-item package-item-featured wow fadeInUp">
							<div class="header-package">
								<i class="fa fa-trophy"></i>
								<h6>Huge Business</h6>
								<h4>Standard</h4>
							</div>
							<div>
								<div class="per-month">
									<span class="per-month-sign">$</span>
									<span class="per-month-amount">50</span>
									<span class="per-month-text">/Month</span>
								</div>
								<div class="package-links">
									<table class="package-link-table">
										<tbody>
											<tr>
												<td class="package-number">25</td>
												<td class="package-text">Job Posting</td>
											</tr>
											<tr>
												<td class="package-number">12</td>
												<td class="package-text">Featured Job</td>
											</tr>
											<tr>
												<td class="package-number">22</td>
												<td class="package-text">Renew Job</td>
											</tr>
											<tr>
												<td class="package-number">60</td>
												<td class="package-text">Days Duration</td>
											</tr>
											<tr>
												<td class="package-number">10</td>
												<td class="package-text">Category</td>
											</tr>
										</tbody>
									</table>

									<p class="mt-4 mb-4">
										<a href="{{ route('contacts') }}" class="btn apply-now-button button-lg">Buy
											Now</a>
									</p>
								</div>
							</div>
						</div>
					</div><!-- Package Single Item -->


					<div class="col-md-4">
						<div class="package-item  wow fadeInRight">
							<div class="header-package">
								<h6>Large Business</h6>
								<h4>Premium</h4>
							</div>
							<div>
								<div class="per-month">
									<span class="per-month-sign">$</span>
									<span class="per-month-amount">100</span>
									<span class="per-month-text">/Month</span>
								</div>
								<div class="package-links">
									<table class="package-link-table">
										<tbody>
											<tr>
												<td class="package-number">15</td>
												<td class="package-text">Job Posting</td>
											</tr>
											<tr>
												<td class="package-number">8</td>
												<td class="package-text">Featured Job</td>
											</tr>
											<tr>
												<td class="package-number">15</td>
												<td class="package-text">Renew Job</td>
											</tr>
											<tr>
												<td class="package-number">30</td>
												<td class="package-text">Days Duration</td>
											</tr>
											<tr>
												<td class="package-number">7</td>
												<td class="package-text">Category</td>
											</tr>
										</tbody>
									</table>

									<p class="mt-4 mb-4">
										<a href="{{ route('contacts') }}"
											class="btn btn-outline-info category-item-link btn-package">Buy Now</a>
									</p>
								</div>
							</div>
						</div>
					</div><!-- Package Single Item -->


				</div>
			</div>

		</div>

	</div>

</section>
<!-- Package -->

<!-- Download App -->
<section class="download-app sec-pad" style="display:none;">
	<div class="container">
		<div class="text-center mb-5">
			<div class="row">
				<div class="col-md-5 wow fadeInLeft">
					<img src="{{ asset('public/images/default/mobile.png') }}" alt="download-app-image"
						class="img img-fluid">
				</div>
				<div class="col-md-7 wow fadeInRight">
					<h3 class="download-app-head">Download <span class="app-text">HireGallaxy</span> App Now</h3>
					<p class="download-app-text">
						It is a long established fact that a reader will be distracted by the readable content of a page
						when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
						distribution of letters
					</p>
					<p class="download-icons">
						<a href="" class="btn apply-now-button button-lg">
							<i class="fa fa-apple"></i> App Store
						</a>
						<a href="" class="btn apply-now-button button-lg">
							<i class="fa fa-play-circle"></i> Play Store
						</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Download App -->

<!-- Subscription Section -->
{{--  <section class="subcsription sec-pad">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="subscription-div">
					<i class="fa fa-envelope"></i>
					<input type="text" name="" id="subscribeEmail" placeholder="Hey Buddy !! Enter your email here "
						class="subscription-input">
					<button type="submit" class="btn apply-now-button button-lg subscription-button">
						Subscribe Now
					</button>
				</div>
			</div>
		</div>
	</div>
</section>  --}}
<!-- Subscription Section -->

@endsection


@section('scripts')

<!-- Client Review owl Carousel -->
<script>
	$('.owl-carousel').owlCarousel({
		loop:true,
		margin:10,
		// nav:true,
		items: 2,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:2
			}
		}
	});
	
	
</script>
<!-- Client Review owl Carousel -->
@endsection