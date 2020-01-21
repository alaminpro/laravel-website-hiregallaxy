<div class="main-navbar">
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
		<div class="container">
			<a class="navbar-brand" href="{{ route('index') }}">
				<img src="{{ asset('images/'.App\Models\Setting::first()->site_logo) }}" class="logo" alt=""
					style="width: 100px;">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
				aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">

				<ul class="navbar-nav ml-auto">
					<li class="nav-item ">
						<a class="nav-link {{ Route::is('index') ? 'nav-link-active' : '' }}"
							href="{{ route('index') }}">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link {{ Route::is('employers') || Route::is('employers.show') ? 'nav-link-active' : '' }}"
							href="{{ route('employers') }}">Employer</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ Route::is('candidates') ? 'nav-link-active' : '' }}"
							href="{{ route('candidates') }}">Candidates</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ Route::is('jobs') || Route::is('jobs.show') ? 'nav-link-active' : '' }}"
							href="{{ route('jobs') }}">Job</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ Route::is('contacts') ? 'nav-link-active' : '' }}"
							href="{{ route('contacts') }}">Contact</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					@if (Auth::check() && Auth::user()->is_company)
					<li class="nav-item">
						<a class="nav-link post-job-button" href="{{ route('jobs.post') }}">
							<i class="fa fa-plus"></i>
							Post a Job
						</a>
					</li>
					@endif

				</ul>
			</div>
		</div>
	</nav>
</div>