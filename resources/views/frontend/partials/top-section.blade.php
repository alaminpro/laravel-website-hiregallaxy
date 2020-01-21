@if (Route::is('index'))


<div class="row">
	<!-- Home Search Section -->
	<div class="col-md-10">
		<div class="home-top">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-10">

						<h3 class="top-title wow fadeInUp">
							The Coolest Way to Get Your <br> Dream Job
						</h3>
						<p class="top-description  wow fadeInLeft">Find Job, Employment, and Career Oppurtunities
						</p>
						@include('frontend.pages.partials.search', ['route' => route('jobs.search') ])

						<div class="companies-more">
							<div class="row">
								<div class="wow slideInLeft col-4">
									<div>
										<span class="icon">
											<i class="fa fa-globe" aria-hidden="true"></i>
										</span>
										<span class="counts-more">
											<span class="count-thing">
												{{ count(App\Models\Country::select('id')->get()) }}
											</span>
											<br>
											<span class="company-more-name">
												Cities
											</span>
										</span>
									</div>
								</div>

								<div class="wow slideInDown col-4">
									<div>
										<span class="icon">
											<i class="fa fa-line-chart" aria-hidden="true"></i>
										</span>
										<span class="counts-more">
											<span class="count-thing">
												@php
												$companies_count = count(App\User::where('is_company',
												1)->where('status',
												1)->get());
												@endphp
												{{ $companies_count }}
											</span>
											<br>
											<span class="company-more-name">
												{{ $companies_count > 1 ? 'Companies':'Company' }}
											</span>
										</span>
									</div>
								</div>
								<div class="wow slideInRight col-4">
									<div>
										<span class="icon">
											<i class="fa fa-user-o" aria-hidden="true"></i>
										</span>
										<span class="counts-more">
											<span class="count-thing">
												@php
												$candidate_counts = count(App\User::where('is_company',
												0)->where('status',
												1)->get());
												@endphp
												{{ $candidate_counts }}
											</span>
											<br>
											<span class="company-more-name">
												{{ $candidate_counts > 1 ? 'Candidates':'Candidate' }}
											</span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Home Job Post, Subscriber and other buttons -->
	<div class="col-md-2 home-right-sidebar-area">
		<div class="home-right-sidebar">
			<div>
				<a href="{{ route('jobs.post') }}" class="btn post-job-button  btn-block">
					<i class="fa fa-upload"></i>
					Post Free Job
				</a>
			</div>
			<div class="mt-2">
			    @if(Auth::check() && Auth::user()->candidate != null)
			    <a href="{{ route('candidates.show', Auth::user()->username) }}" class="btn post-job-button btn-success  btn-block">
					<i class="fa fa-pencil-square-o"></i>
					Create CV Free
				</a>
				
			    @elseif(Auth::check() && Auth::user()->company != null)
			    <a href="{{ route('employers.show', Auth::user()->username) }}" class="btn post-job-button btn-success  btn-block">
					<i class="fa fa-pencil-square-o"></i>
					Create CV Free
				</a>
				@else
                <a href="{{ route('login') }}" class="btn post-job-button btn-success  btn-block">
					<i class="fa fa-pencil-square-o"></i>
					Login to Create CV
				</a>
			    @endif
				
			</div>
			<div class="mt-2">
				<a href="#SubscriberModal" class="btn post-job-button btn-job-alert  btn-block" data-toggle="modal">
					<i class="fa fa-bell"></i>
					Create Job Alert
				</a>
			</div>

			<!-- Advertising Block -->
			<div class="mt-4">
				<div class="add-block"></div>
			</div>

		</div>


		<!-- Subscriber Modal -->
		<div class="modal fade" id="SubscriberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							Subscribe Now
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div>
							<p>
								Are you willing to get notifications whenever a new job post added ?
							</p>
							<div class="mt-4">
								<input type="email" id="subscriber-email" class="form-control"
									placeholder="Enter your email address" />
							</div>
							<div id="subscriber-message"></div>
						</div>
						<div class="mt-3 text-center">
							<button type="button" class="btn btn-success btn-lg" id="subscribe-button">
								<i class="fa fa-check"></i> Yes ! I'm In
								<span class="hidden">'</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- End Subscriber Modal -->


	</div> <!-- Header top sidebar -->
</div>




@elseif(Route::is('jobs'))
<div class="home-top">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">

				<h3 class="top-title wow fadeInUp mb-3">
					Find Your Dream Job
				</h3>
				@include('frontend.pages.partials.search', ['route' => route('jobs.search') ])

				<div class="navbar-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Jobs</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>

@elseif(Route::is('jobs.show'))
<div class="home-top">

</div>

@elseif(Route::is('candidates'))
<div class="home-top">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">

				<h3 class="top-title wow fadeInUp mb-3">
					Find Perfect Candidate
				</h3>

				{{--  @include('frontend.pages.partials.search', ['route' => route('candidates.search') ])  --}}

				<form action="{{ route('candidates.search') }}" method="get">
					<div class="job-searchbox candidate-searchbox">
						<div class="row">
							<div class="col-sm-5 col-xs-5">
								<input type="text" name="search" class="form-control"
									placeholder="Enter Job Title, Candidate Name">
							</div>
							<div class="col-sm-4 col-xs-4">
								<select name="category" id="category" class="selectpicker" data-live-search="true">
									<option data-icon="fa fa-navicon" value="all">All Positions</option>
									@foreach (App\Models\Category::orderBy('name', 'asc')->get() as $category)
									<option value="{{ $category->slug }}">{{ $category->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-3 col-xs-3">
								<button type="submit" class="btn btn-info search-button">
									Search
								</button>
							</div>
						</div>
					</div> <!-- End Searchbox -->
				</form>

				<div class="navbar-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>

						@if(Route::is('candidates'))
						<li class="breadcrumb-item active" aria-current="page">Candidates</li>
						@endif

					</ol>
				</div>

			</div>
		</div>
	</div>
</div>


@elseif(Route::is('employers'))
<div class="home-top">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">

				<h3 class="top-title wow fadeInUp mb-3">
					Find Employer
				</h3>

				<form action="{{ route('employers.search') }}" method="get">
					<div class="job-searchbox">
						<div class="row">
							<div class="col-sm-9 col-xs-9">
								<input type="text" name="search" class="form-control"
									placeholder="Enter Job Title, Employer Name">
							</div>
							<div class="col-sm-3 col-xs-3">
								<button type="submit" class="btn btn-info search-button">
									Search
								</button>
							</div>
						</div>
					</div> <!-- End Searchbox -->
				</form>

				<div class="navbar-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Employers</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
</div>


@elseif(Route::is('employers.dashboard') || Route::is('candidates.dashboard') || Route::is('employers.jobs.posted') ||
Route::is('employers.jobs.favorite') || Route::is('candidates.jobs.favorite') || Route::is('employers.messages') ||
Route::is('candidates.messages') || Route::is('employers.jobs.applications') || Route::is('candidates.jobs.applied'))
<!-- -->
@elseif(Route::is('password.request') || Route::is('password.reset'))
<!-- -->

@else
<div class="home-top">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">

				<h3 class="top-title wow fadeInUp">
					@if(Route::is('contacts'))
					Contact Us
					@elseif(Route::is('employers.show'))
					Employer - {{ $user->name }}
					@elseif(Route::is('candidates.show'))
					Candidate Details
					@elseif(Route::is('jobs.post'))
					Post A New Job
					@elseif(Route::is('register'))
					Sign Up
					@elseif(Route::is('jobs.search'))
					Search Jobs
					@elseif(Route::is('candidates.search'))
					Search Candidates
					@elseif(Route::is('employers.search'))
					Search Employers
					@elseif(Route::is('jobs.categories.show'))
					Jobs in - {{ $category->name }} Category
					@elseif(Route::is('jobs.edit'))
					Edit - {{ $job->title }}

					@elseif(Route::is('terms'))
					Terms and Service

					@elseif(Route::is('privacy'))
					Privacy Policy

					@else
					404 | Page Not Found
					@endif
				</h3>
				@if(Route::is('employers.search'))
				<form action="{{ route('employers.search') }}" method="get">
					<div class="job-searchbox">
						<div class="row">
							<div class="col-sm-9 col-xs-9">
								<input type="text" name="search" class="form-control"
									placeholder="Enter Job Title, Employer Name">
							</div>
							<div class="col-sm-3 col-xs-3">
								<button type="submit" class="btn btn-info search-button">
									Search
								</button>
							</div>
						</div>
					</div> <!-- End Searchbox -->
				</form>
				@elseif(Route::is('candidates.search'))
				{{--  @include('frontend.pages.partials.search', ['route' => route('candidates.search') ])  --}}

				<form action="{{ route('candidates.search') }}" method="get">
					<div class="job-searchbox candidate-searchbox">
						<div class="row">
							<div class="col-sm-5 col-xs-5">
								<input type="text" name="search" class="form-control"
									placeholder="Enter Job Title, Candidate Name">
							</div>
							<div class="col-sm-4 col-xs-4">
								<select name="category" id="category" class="selectpicker" data-live-search="true">
									<option data-icon="fa fa-navicon" value="all">All Positions</option>
									@foreach (App\Models\Category::orderBy('name', 'asc')->get() as $category)
									<option value="{{ $category->slug }}">{{ $category->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-3 col-xs-3">
								<button type="submit" class="btn btn-info search-button">
									Search
								</button>
							</div>
						</div>
					</div> <!-- End Searchbox -->
				</form>
				@elseif(Route::is('jobs.search'))
				@include('frontend.pages.partials.search', ['route' => route('jobs.search') ])
				@else
				<!--bye-->
				@endif

				<div class="navbar-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>

						@if(Route::is('employers'))
						<li class="breadcrumb-item active" aria-current="page">Employers</li>
						@elseif(Route::is('employers.show'))
						<li class="breadcrumb-item"><a href="{{ route('employers') }}">Employers</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
						@elseif(Route::is('candidates.show'))
						<li class="breadcrumb-item"><a href="{{ route('candidates') }}">Candidates</a></li>
						<li class="breadcrumb-item active" aria-current="page">Candidate Details</li>
						@elseif(Route::is('contacts'))
						<li class="breadcrumb-item active" aria-current="page">Contact</li>
						@elseif(Route::is('jobs.post'))
						<li class="breadcrumb-item active" aria-current="page">Post a job</li>
						@elseif(Route::is('register'))
						<li class="breadcrumb-item active" aria-current="page">Sign Up</li>
						@elseif(Route::is('jobs.search'))
						<li class="breadcrumb-item active" aria-current="page">Search Jobs</li>
						@elseif(Route::is('candidates.search'))
						<li class="breadcrumb-item active" aria-current="page">Search Candidates</li>
						@elseif(Route::is('employers.search'))
						<li class="breadcrumb-item active" aria-current="page">Search Employers</li>
						@elseif(Route::is('jobs.categories.show'))
						<li class="breadcrumb-item"><a href="{{ route('index') }}">Categories</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
						@elseif(Route::is('jobs.edit'))
						<li class="breadcrumb-item"><a href="{{ route('jobs') }}">Jobs</a></li>
						<li class="breadcrumb-item active" aria-current="page">Edit - {{ $job->title }}</li>
						@elseif(Route::is('terms'))

						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Terms and Service</li>
						@elseif(Route::is('privacy'))
						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
						@else
						<li class="breadcrumb-item active" aria-current="page">404 - Page Not Found</li>
						@endif
					</ol>
				</div>

			</div>
		</div>
	</div>
</div>

@endif