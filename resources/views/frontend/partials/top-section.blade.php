@if (Route::is('index'))
<div class="home-top header-index">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h3 class="top-title wow fadeInUp custom__title"> 
					Simplify your hiring and job search process, get <span class="text-danger">prescreened</span> candidates to your inbox!
				</h3>
				<p class="top-description  wow fadeInLeft custom__description">
					Discover
				</p>
			
				@include('frontend.pages.partials.search', ['route' => route('jobs.search') ])
				<div class="companies-more">
					<div class="row">
						<div class="wow slideInLeft col-sm-4 custom__back ">
							<div class=" d-flex align-items-center">
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
						<div class="wow slideInDown col-sm-4 custom__back">
							<div class="d-flex align-items-center">
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
						<div class="wow slideInRight col-sm-4  custom__back">
							<div class="d-flex align-items-center">
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
			<div class="col-lg-6 d-lg-flex d-none align-items-center">
				<img src="{{ asset('images/team.png') }}" class="img-fluid" alt="">
			</div>
		</div>
	</div>
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

@elseif(Route::is('employers.applicants'))

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					List of Applicants

				</h3>

				<div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('employers.dashboard') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Applicants</li>

					</ol>

				</div>

			</div>

		</div>

	</div>

</div>

@elseif(Route::is('employers.listed'))

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					List of Applicants

				</h3>

				<!-- <div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('employers.dashboard') }}">Home</a></li>

						<li class="breadcrumb-item"><a href="{{ route('employers.dashboard') }}">All Applicants</a></li>

						<li class="breadcrumb-item active" aria-current="page">Applicants</li>

					</ol>

				</div> -->

			</div>

		</div>

	</div>

</div>

@elseif(Route::is('employers.candidate'))

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					List of Candidates

				</h3>

				<!-- <div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('employers.dashboard') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Candidates</li>

					</ol>

				</div> -->

			</div>

		</div>

	</div>

</div>
@elseif(Route::is('team.candidate'))

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-12">



				<h3 class="top-title wow fadeInUp mb-3">

					List of Candidates

				</h3>

				 <div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>

						<li class="breadcrumb-item active" aria-current="page">Candidates</li>

					</ol>

				</div> 

			</div>

		</div>

	</div>

</div>

@elseif(Route::is('employers.jobs.listed'))

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					List of Jobs

				</h3>
<!-- 
				<div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('employers.dashboard') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Listed Jobs</li>

					</ol>

				</div> -->

			</div>

		</div>

	</div>

</div>

@elseif(Route::is('employers.total'))

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					List of All Applicants

				</h3>

				<div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('employers.dashboard') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Total Applications</li>

					</ol>

				</div>

			</div>

		</div>

	</div>

</div>
@elseif(Route::is('team.total'))

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					List of All Applicants

				</h3>

				<div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Total Applications</li>

					</ol>

				</div>

			</div>

		</div>

	</div>

</div>

@elseif(Route::is('employers.applicants.edit'))

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					Edit Applicant

				</h3>

				<div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('employers.dashboard') }}">Home</a></li>

						<li class="breadcrumb-item"><a href="{{ route('employers.applicants') }}">Applicants</a></li>

						<li class="breadcrumb-item active" aria-current="page">Applicants</li>

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

						<li class="breadcrumb-item"><a href="{{ route('employers.dashboard') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Employers</li>

					</ol>

				</div>



			</div>

		</div>

	</div>

</div>

@elseif(Route::is('exam')) 

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					Online Skill Test

				</h3>  

				<div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Skill Test</li>

					</ol>

				</div>

			</div>

		</div>

	</div>

</div>

@elseif(Route::is('personality')) 

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					Test your personality

				</h3>  

				<div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Personality Test</li>

					</ol>

				</div>

			</div>

		</div>

	</div>

</div>

@elseif(Route::is('aptitude')) 

<div class="home-top">

	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10">



				<h3 class="top-title wow fadeInUp mb-3">

					Test your aptitude

				</h3>  

				<div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Aptitude test</li>

					</ol>

				</div>

			</div>

		</div>

	</div>

</div>
@elseif(Route::is('companies')) 
 
@elseif(Route::is('team.companies')) 
 
@elseif(Route::is('company.create')) 
 
@elseif(Route::is('company.show')) 

@elseif(Route::is('team.company.show')) 

@elseif(Route::is('company.edit')) 

@elseif(Route::is('show-result')) 

<div class="home-top">
 
	<div class="container">

		<div class="row justify-content-center">

			<div class="col-md-10"> 

				<h3 class="top-title wow fadeInUp mb-3">

					Online Skill Test Result

				</h3>  

				<div class="navbar-breadcrumb">

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Result</li>

					</ol>

				</div>

			</div>

		</div>

	</div>

</div>



@elseif(Route::is('employers.dashboard') || Route::is('teams') || Route::is('team.create') || Route::is('team.dashboard') || Route::is('candidates.dashboard') || Route::is('employers.jobs.posted') ||
 Route::is('team.jobs.posted') ||
Route::is('employers.search.candidates') || Route::is('team.search.candidates') || Route::is('candidates.jobs.favorite') || Route::is('employers.messages') || Route::is('team.messages') ||

Route::is('candidates.messages') || Route::is('employers.jobs.applications') || Route::is('team.jobs.applications') ||Route::is('candidates.jobs.applied'))

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
					@elseif(Route::is('team.show'))

					Team - {{ $user->name }}

					@elseif(Route::is('candidates.show'))

					Candidate Details

					@elseif(Route::is('candidates.personality'))

					Personality Details

					@elseif(Route::is('public.personality'))

					Personality Details

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

					@elseif(Route::is('about_us'))

					About us



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

						 
						@elseif(Route::is('team.show'))

						<li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Team</a></li>

						<li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>

						 

						@elseif(Route::is('candidates.show'))

						<li class="breadcrumb-item"><a href="{{ route('candidates') }}">Candidates</a></li>

						<li class="breadcrumb-item active" aria-current="page">Candidate Details</li>

						@elseif(Route::is('public.personality')) 

						<li class="breadcrumb-item active" aria-current="page">Personality Details</li> 

						@elseif(Route::is('candidates.personality'))

						<li class="breadcrumb-item"><a href="{{ route('candidates') }}">Candidates</a></li>

						<li class="breadcrumb-item active" aria-current="page">Personality Details</li>

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

						@elseif(Route::is('about_us'))
 

						<li class="breadcrumb-item active" aria-current="page">About-us</li>

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