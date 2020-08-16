<form action="{{ $route }}" method="get">
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
</form>