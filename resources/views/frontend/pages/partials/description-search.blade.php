<form action="" method="get" id="JobDesSearchForm">
	<input type="hidden" name="job_description">
	<div class="sidebar-widget">

		<div class="sidebar-list-item">

			<h3>

				All Categories

			</h3>

			<hr class="sidebar-border">

			<div class="clearfix"></div>

			@foreach (App\Models\Category::orderBy('name', 'asc')->get() as $cat)

			<div class="squaredFour">

				<input type="checkbox" value="{{ $cat->slug }}" id="category{{ $cat->id }}" name="category"

					onchange="submitSearch()"

					{{ isset($_GET['category']) && ($_GET['category'] == $cat->slug) ? 'checked' : '' }} />

				<label for="category{{ $cat->id }}"></label>

				{{ $cat->name }} ({{ count(App\Models\Template::where('category_id', $cat->id)->get()) }})

			</div>

			@endforeach

		</div>

	</div> 

</form>