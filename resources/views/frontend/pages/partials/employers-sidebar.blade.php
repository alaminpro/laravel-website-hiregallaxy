<div class="employer-detail-sidebar">
	<img src="{{ App\Helpers\ReturnPathHelper::getUserImage($user->id) }}" class="img img-fluid">
	<div class="single-job-description mt-2">
		<h3>{{ $user->name }}</h3>
		<p class="text-yellow mb-3"> {{ $user->company->category->name }}</p>
	</div>
	<div class="user-sidebar">
		<div class="list-group">
			<a href="{{ route('employers.dashboard') }}" class="list-group-item list-group-item-action {{ Route::is('employers.dashboard') ? 'active' : '' }}">
				<i class="fa fa-dashboard"></i> Dashboard
			</a>

			<a href="{{ route('employers.jobs.posted') }}" class="list-group-item list-group-item-action {{ Route::is('employers.jobs.posted') ? 'active' : '' }}">
				<i class="fa fa-bell"></i> My Posted Jobs
			</a>

			<a href="{{ route('employers.jobs.favorite') }}" class="list-group-item list-group-item-action {{ Route::is('employers.jobs.favorite') ? 'active' : '' }}">
				<i class="fa fa-heart"></i> Favorite Jobs
			</a>

			<a href="{{ route('employers.messages') }}" class="list-group-item list-group-item-action {{ Route::is('employers.messages') ? 'active' : '' }}">
				<i class="fa fa-envelope"></i> Messages
			</a>

			<a href="{{ route('employers.show', $user->username) }}" class="list-group-item list-group-item-action">
				<i class="fa fa-edit"></i> Edit My Profile
			</a>
		</div>
	</div>
</div>