<div class="main-navbar">
	<!-- Navigation -->
	<div class="">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
		<div class="container-fluid nav-container">
			@if (Auth::check() && Auth::user()->is_company)
      		<label for="check" >
        		<button class="fa fa-bars btn btn-primary" id="sidebar_btn"></button>
        		<button class="fa fa-close btn btn-danger btn-close-sidebar" id="sidebar_close"></button>
      		</label>
      		<div class="sidebar" id="sidebar">
			  <a href="{{ route('employers.dashboard') }}"><i class="fa fa-desktop"></i><span>Dashboard</span></a>
			  <a href="{{ route('employers.jobs.posted') }}"><i class="fa fa-bell"></i><span>My Posted Job</span></a>
			  <!-- <a href="{{ route('employers.applicants') }}"><i class="fa fa-users"></i><span>Applicants</span></a> -->
			  <a href="{{ route('employers.search.candidates') }}"><i class="fa fa-search"></i><span>Search Cadidates</span></a>
			  <a href="{{ route('employers.messages') }}"><i class="fa fa-envelope"></i><span>Messages</span></a>
			  <a href="{{ route('employers.show', Auth::user()->username) }}"><i class="fa fa-edit"></i><span>Edit My Profile</span></a>
			</div>
      		@endif

			<a class="navbar-brand" href="{{ route('index') }}">
				<h3 class="font-3">Hiregalaxy</h3>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"	aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item ">
						<a class="nav-link {{ Route::is('index') ? 'nav-link-active' : '' }}" href="{{ route('index') }}">Home<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link {{ Route::is('employers') || Route::is('employers.show') ? 'nav-link-active' : '' }}" href="{{ route('employers') }}">Employer</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ Route::is('candidates') ? 'nav-link-active' : '' }}" href="{{ route('candidates') }}">Candidates</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ Route::is('jobs') || Route::is('jobs.show') ? 'nav-link-active' : '' }}" href="{{ route('jobs') }}">Job</a>
					</li> 
				</ul>
				<ul class="navbar-nav ml-auto">
					@if (Auth::check() && Auth::user()->is_company)
					<li class="nav-item">
						<a class="nav-link post-job-button" href="{{ route('jobs.post') }}" title="post job">
							<i class="fa fa-plus"></i>
						<span class="hidden_sm_job_text">	Post a Job</span>
						</a>
					</li>
					@endif
				</ul>

				@if (Auth::check())
				<div class="float-right">
					<div class="top-authentication-links custom-auth-links">
						<a href="{{ Auth::user()->is_company ? route('employers.messages') : route('candidates.messages') }}">
							<i class="fa fa-envelope"></i> 
							<span class="message-count">
								{{ count(Auth::user()->received_messages->where('is_seen',0)) }} 
							</span>
							<span class="message__hidden">	New Message</span>
						</a>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownAccountButton">
							<img src="{{ App\Helpers\ReturnPathHelper::getUserImage(Auth::user()->id) }}" class="account-img">
				 
							 {{ str_limit(Auth::user()->name , $limit = 3, $end = '..') }}</a>
						<div class="dropdown-menu dropdown-menu-account" aria-labelledby="dropdownAccountButton">
							@if(auth()->check() && auth()->user()->type == 1)
								<a class="dropdown-item dropdown-account-item" href="{{ route('team.dashboard', auth()->user()->id) }}"><i class="fa fa-dashboard"></i> Dashboard</a>
								<a class="dropdown-item dropdown-account-item" target="_blank" href="{{ route('team.show', Auth::user()->username) }}"><i class="fa fa-user"></i> Profile</a>
							@else
								<a class="dropdown-item dropdown-account-item" href="{{ route('users.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
								<a class="dropdown-item dropdown-account-item" target="_blank" href="{{ Auth::user()->is_company ? route('employers.show', Auth::user()->username) : route('candidates.show', Auth::user()->username) }}"><i class="fa fa-user"></i> Profile</a>
							@endif
							<a class="dropdown-item dropdown-account-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</div>
				</div>
				@else
				<div class="float-right">
					<div class="top-authentication-links">
						<a href="{{ route('register') }}" class="btn-primary">Join Us</a>
						@if (!Route::is('login'))
						<a href="#signInModal" data-toggle="modal" class="btn-secondary">Login</a>
						@endif
					</div>
				</div>
				@endif

			</div>
		</div>
	</nav>
	</div>
</div>

 