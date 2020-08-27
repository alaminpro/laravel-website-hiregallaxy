@extends('frontend.layouts.master')



@section('title')

Employers | {{ App\Models\Setting::first()->site_title }}

@endsection





@section('stylesheets')



@endsection





@section('content')

<section class="employer-page sec-pad">

	<div class="container">

		<h5 class="text-theme bold mb-4 float-left">We have found <span class="text-yellow">{{ count($templates) }}</span>

			Matches for you </h5> 
		   

		<div class="clearfix"></div>



		<div class="row">

			<div class="col-md-4">

				<div class="left-sidebar">

					<div class="toggleNav">

						<button class="btn btn-outline-secondary btn-toggle"><i class="fa fa-bars"></i></button>

					</div>

					<div class="toggleNav2">

						<button class="btn btn-outline-secondary btn-toggle"><i class="fa fa-times"></i></button>

					</div>

					<div id="left-sidebar">

						@include('frontend.pages.partials.description-search')

					</div>

				</div>

			</div>

			<div class="col-md-8">

				<div class="page-employer">

					<div class="employee-header-section">

						<div class="float-left">

							<select name="" id="">

								<option value="">Most Recent</option>

							</select>

						</div>

						<div class="float-right">

							<span class="text-theme">

								You are watching <span class="count-text">{{ $pageNoText }}</span>

							</span>

						</div>

						<div class="clearfix"></div>

					</div>

					@foreach ($templates as $key => $template)

                    <div class="single-job-short single-template d-flex align-items-center justify-content-between px-4"> 
                    
                        <div class="ml-2 single-job-description">
                    
                            <h4><a href="{{ route('jobDescription', $template->id) }}">{{ $template->name }}</a></h4>  
                            <p class="text-theme mb-2">   {{ $template->category->name }}</p> 
                               <p class="mt-2">
                            {!! $template->job_summery !!}
                                
                            </p>
                    
                        </div> 
                        <a class="btn btn-secondary ml-4" href="{{ route('jobDescription', $template->id) }}">view</a>
                    </div> 

					@endforeach



					@if (count($templates) == 0)

					<div class="alert alert-danger mt-2">

						<strong>Sorry !!</strong>

						<br>

						<p>We have not found any employee for this query now !!</p>

					</div>

					@endif



					<div class="page-pagination mt-4">

						{{ $templates->links() }}

					</div>

				</div>

			</div>

		</div>

 
	</div>

</section>

@endsection





@section('scripts')

<script>

	$("input:checkbox").on('click', function() {

		var $box = $(this);

		if ($box.is(":checked")) {

			var group = "input:checkbox[name='" + $box.attr("name") + "']";

			$(group).prop("checked", false);

			$box.prop("checked", true);

		} else {

			$box.prop("checked", false);

		}

	});



	function submitSearch(event){

		 $("#JobDesSearchForm").submit();

	}

</script>

@endsection