<form action="{{ $route }}" method="get" id="employerSearchForm">
	<input type="hidden" name="company">
	<div class="sidebar-widget">
		<div class="sidebar-widget">

			<div class="sidebar-list-item">
	
				<h3>
	
					Jobs By City
	
				</h3>
	
				<hr class="sidebar-border">
	
				<div class="clearfix"></div>
	
	
	
				<select name="country" onchange="submitSearch()" id="country" class="selectpicker" data-live-search="true">
	
					<option data-icon="fa fa-map-marker" value="all">All Locations</option>
	
					@foreach (App\Models\State::orderBy('name', 'asc')->get() as $state)
	
					<option value="" disabled style="font-weight: bolder;font-size: 16px;">
	
						{{ $state->name }}
	
					</option>
	
					@foreach ($state->cities()->orderBy('name', 'asc')->get() as $countrySingle)
	
					<option value="{{ $countrySingle->name }}"
	
						{{ isset($_GET['country']) && ($_GET['country'] == $countrySingle->name) ? 'selected' : '' }}>
	
						&nbsp;&nbsp; {{ $countrySingle->name }}
	
						({{ count(App\Models\Job::where('status_id', 1)->where('country_id', $countrySingle->id)->get()) }})
	
					</option>
	
					@endforeach
	
					@endforeach
	
				</select>
	
			</div>
	
		</div>
	
		<div class="sidebar-list-item">

			<h3>

				All Positions

			</h3>

			<hr class="sidebar-border">

			<div class="clearfix"></div>

			@foreach (App\Models\Category::orderBy('name', 'asc')->get() as $cat)

			<div class="squaredFour">

				<input type="checkbox" value="{{ $cat->slug }}" id="category{{ $cat->id }}" name="category"

					onchange="submitSearch()"

					{{ isset($_GET['category']) && ($_GET['category'] == $cat->slug) ? 'checked' : '' }} />

				<label for="category{{ $cat->id }}"></label>

				{{ $cat->name }} ({{ count(App\Models\CompanyProfile::where('category_id', $cat->id)->get()) }})

			</div>

			@endforeach

		</div>

	</div>






	<div class="sidebar-widget">

		<div class="sidebar-list-item">

			<h3>

				Team Size

			</h3>

			<hr class="sidebar-border">

			<div class="clearfix"></div>



			@foreach (App\Models\TeamSize::orderBy('id', 'asc')->get() as $teamSizeSingle)

			<div class="squaredFour">

				<input type="checkbox" value="{{ $teamSizeSingle->id }}" id="team{{ $teamSizeSingle->id }}" name="team"

					onchange="submitSearch()"

					{{ isset($_GET['team']) && ($_GET['team'] == $teamSizeSingle->id) ? 'checked' : '' }} />

				<label for="team{{ $teamSizeSingle->id }}"></label>

				{{ $teamSizeSingle->name }}

				({{ count(App\Models\CompanyProfile::where('team_member', $teamSizeSingle->id)->get()) }})

			</div>

			@endforeach



		</div>

	</div>





</form>