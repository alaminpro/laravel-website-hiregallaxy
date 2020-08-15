<div class="single-job-short single-employer">
	<div class="float-left">
		@if (!is_null($single_job->user->profile_picture))
		<img src="{{ asset('public/images/users/'.$single_job->user->profile_picture) }}">
		@else
		<i class="{{ $single_job->category->icon }} job-category-icon"></i>
		@endif
	</div>
	<div class="float-left  ml-2 single-job-description">
		<h4 class="pointer" onclick="location.href='{{ route('jobs.show', $single_job->slug) }}'">
			{{ $single_job->title }}</h4>
		<p><i class="fa fa-shopping-bag category-icon"></i> {{ $single_job->category->name }}</p>
		<p><i class="fa fa-map-marker location-icon"></i>
			{{ $single_job->location != null ?  $single_job->location .',' : '' }} </i> {{ $single_job->country->name }}
		</p>
		<p><i class="fa fa-clock-o time-icon"></i> {{ $single_job->type->name }} </p>

		@if (Route::is('index'))
		<p class="mt-0">

			@if (Auth::check())
			@if (Auth::user()->hasAppliedJob($single_job->id))
			<a href="#update-apply-job-modal" data-toggle="modal" class="btn btn-outline-success"
				onclick="applyUpdateJobDataSet({{ $single_job->id }}, '{{ $single_job->getCurrencyName() }}')">
				<span class="text-success"><i class="fa fa-check"></i> Already Applied</span>
			</a>
			@else
			<a href="#apply-job-modal" data-toggle="modal" class="btn apply-now-button"
				onclick="applyJobDataSet({{ $single_job->id }}, '{{ $single_job->getCurrencyName() }}')">
				Apply Now
			</a>
			@endif
			@else
			<a href="#apply-job-modal" data-toggle="modal" class="btn apply-now-button"
				onclick="applyJobDataSet({{ $single_job->id }}, '{{ $single_job->getCurrencyName() }}')">
				Apply Now
			</a>
			@endif
		</p>
		@endif
	</div>

	<div class="float-right mb-3 text-right">

		@if (Route::is('employers.jobs.posted'))
		<a href="{{ route('jobs.edit', $single_job->slug) }}" class="btn btn-outline-success">
			<i class="fa fa-edit"></i> Edit Job
		</a>
		<a href="{{ route('employers.jobs.applications', $single_job->slug) }}" class="btn btn-outline-yellow">
			<i class="fa fa-eye"></i> All Applications
			<span class="badge badge-danger">{{ count($single_job->activities) }}</span>
		</a>
		@else
		@if (Auth::check())
		<favorite-component url="{{ url('/') }}" id="{{ $single_job->id }}" api_token="{{ Auth::user()->api_token }}">
		</favorite-component>
		@else
		<favorite-component url="{{ url('/') }}" id="{{ $single_job->id }}" api_token="0"></favorite-component>
		@endif
		<br>
		@if (!Route::is('index'))
		@if (Auth::check())
		@if (Auth::user()->hasAppliedJob($single_job->id))
		<a href="#update-apply-job-modal" data-toggle="modal" class="btn btn-outline-success"
			onclick="applyUpdateJobDataSet({{ $single_job->id }}, '{{ $single_job->getCurrencyName() }}')">
			<span class="text-success"><i class="fa fa-check"></i> Already Applied</span>
		</a>
		@else
		<a href="#apply-job-modal" data-toggle="modal" class="btn btn-outline-yellow"
			onclick="applyJobDataSet({{ $single_job->id }}, '{{ $single_job->getCurrencyName() }}')">
			Apply Now
		</a>
		@endif
		@else
		<a href="#apply-job-modal" data-toggle="modal" class="btn btn-outline-yellow"
			onclick="applyJobDataSet({{ $single_job->id }}, '{{ $single_job->getCurrencyName() }}')">
			Apply Now
		</a>
		@endif

		@endif
		@endif

	</div>
	<div class="clearfix"></div>
</div>