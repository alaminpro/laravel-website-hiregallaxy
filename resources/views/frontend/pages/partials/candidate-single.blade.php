<!-- Candidate single item -->
<div class="single-job-short single-employer" onclick="location.href='{{ route('candidates.show', $single_user->username) }}'">
	<div class="float-left">
		<img src="{{ App\Helpers\ReturnPathHelper::getUserImage($single_user->id) }}">
	</div>
	<div class="float-left  ml-2 single-job-description">
		<h4>{{ $single_user->name }}</h4>
		<p class="text-theme mb-2"> 
			@foreach ($single_user->categories as $catSingleUser)
			<a href="{{ route('jobs.categories.show', $catSingleUser->category->slug) }}">{{ $catSingleUser->category->name }}</a>
			@endforeach
		</p>
		<p class="mt-2">
			<span class="">
				<i class="fa fa-map-marker location-icon"></i> {{ $single_user->location->street_address }}, {{ $single_user->location->country->name }}
			</span>
		</p>
		<p>
			@foreach ($single_user->skills as $sk)
			<span class="mr-2 expertise-tag" onclick="location.href='{{ route('jobs.skills.show', $sk->skill->slug) }}'">
				<i class="fa fa-tags mr-2"></i> {{ $sk->skill->name }}
			</span>
			@endforeach
		</p>
	</div>
	<div class="float-right">
		<a onclick="location.href='{{ route('candidates.show', $single_user->username) }}'" class="btn apply-now-button">
			View Resume
		</a>
	</div>
	<div class="clearfix"></div>
</div> 