
	<form action="{{ $route }}" method="get" class="search__form">

		<div class="job-searchbox"> 
			<div class="input__search">
				<input type="text" name="job" class="form-control" placeholder="Find Job: title, keywords">
			</div>
			<div class="input__city">
				<input type="text" name="location" class="form-control" placeholder="Where: city">
			</div> 
			<div class="custom__search_bar">
				<div class="dropdown">
					<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" data-id="jobs" href="javascript:void(0)">Jobs</a> 
						<a class="dropdown-item" data-id="company" href="javascript:void(0)">Company</a> 
						<a class="dropdown-item" data-id="candidate" href="javascript:void(0)">Candidate</a> 
						<a class="dropdown-item" data-id="job_description" href="javascript:void(0)">Job description</a> 
					</div>
				</div>
				<div class="input__submit">
					<button type="submit"><i class="fa fa-search"></i></button>
				</div>
				<div class="advanced__search">
					<button class="advanced__search_btn" type="button"><i class="fa fa-ellipsis-v" aria-hidden="true"></i>
					</button>
				</div>
			</div>
		</div> <!-- End Searchbox -->
		<div class="advanced__seach_show">
			<div class="job_search">
				<select name="category" id="category" class="selectpicker" data-live-search="true">

					<option data-icon="fa fa-navicon" value="all">All Postions</option>
	
					@foreach (App\Models\Category::orderBy('name', 'asc')->get() as $category)
	
					<option value="{{ $category->slug }}">{{ $category->name }}</option>
	
					@endforeach
	
				</select>
				<select name="experience" id="experience" class="selectpicker ml-0 ml-md-4 mt-4 mt-md-0" data-live-search="true">
	
					<option data-icon="fa fa-star" value="all">All Experience</option>
	
					@foreach (App\Models\Experience::orderBy('name', 'asc')->get() as $exp)
	
					<option value="{{ $exp->slug }}">{{ $exp->name }}</option>
	
					@endforeach
	
				</select>
			</div>
		</div>
	</form>
{{-- <form action="{{ $route }}" method="get">

	<div class="job-searchbox">

		<div class="row">

			<div class="col-sm-4 col-xs-4">

				<input type="text" name="search" class="form-control" placeholder="Enter Job Title, Employer">

			</div>

			<div class="col-sm-2 col-xs-2">

				<select name="country" id="country" class="selectpicker" data-live-search="true">

					<option data-icon="fa fa-map-marker" value="all">All Locations</option>

					@foreach (App\Models\State::orderBy('name', 'asc')->get() as $state)

					<option value="" disabled style="font-weight: bolder;font-size: 16px;">

						{{ $state->name }}

					</option>

					@foreach ($state->cities()->orderBy('name', 'asc')->get() as $country)

					<option value="{{ $country->name }}">

						&nbsp; &nbsp;

						{{ $country->name }}

					</option>

					@endforeach

					@endforeach

				</select>

			</div>

			<div class="col-sm-2 col-xs-2">

				<select name="category" id="category" class="selectpicker" data-live-search="true">

					<option data-icon="fa fa-navicon" value="all">All Postions</option>

					@foreach (App\Models\Category::orderBy('name', 'asc')->get() as $category)

					<option value="{{ $category->slug }}">{{ $category->name }}</option>

					@endforeach

				</select>

			</div>

			<div class="col-sm-2 col-xs-2">

				<select name="experience" id="experience" class="selectpicker" data-live-search="true">

					<option data-icon="fa fa-star" value="all">All Experience</option>

					@foreach (App\Models\Experience::orderBy('name', 'asc')->get() as $exp)

					<option value="{{ $exp->slug }}">{{ $exp->name }}</option>

					@endforeach

				</select>

			</div>

			<div class="col-sm-2 col-xs-2">

				<button type="submit" class="btn btn-info search-button">

					Search

				</button>

			</div>

		</div>

	</div> <!-- End Searchbox -->

</form> --}}