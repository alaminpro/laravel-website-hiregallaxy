<form action="{{ $route }}" method="get" id="employerSearchForm">
	<input type="hidden" name="company">
	<div class="sidebar-widget"> 
			<div class="sidebar-list-item">
		
				<h3>
	
					Employer By City
	
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
	</div>
	<div class="sidebar-widget">
		
		<div class="sidebar-list-item">

			<h3>

				All Sectors

			</h3>

			<hr class="sidebar-border">

			<div class="clearfix"></div>

			<select name="sector[]"   id="sector" class="selectpicker" data-live-search="true" multiple>
 
				<option data-icon="fa fa-navicon" value="all">All Sectors</option>

				@foreach (App\Models\Sector::orderBy('name', 'asc')->get() as $sector)

				<option value="{{ $sector->id }}">{{ $sector->name }}</option>

				@endforeach

			</select> 
			<button type="submit" class="btn btn-warning mt-2">Search</button> 
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