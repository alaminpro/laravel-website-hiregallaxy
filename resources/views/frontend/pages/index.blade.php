@extends('frontend.layouts.master')
@section('title')
{{ App\Models\Setting::first()->site_title }} | HomePage
@endsection
@section('stylesheets')
@endsection
@section('content')
 

<!-- Popular Positions Area -->
 
 

<section class="trending_job_cetegory" >
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h2 class="trending__title">Trending jobs 
				</h2>
			</div>
			<div class="col-lg-6">
				<ul class="trending__tag">
					@foreach($top_job_cate as $data)
					<li><a href="{{ route('jobs.search', ['job' => '', 'category'=> $data->slug]) }}">{{ $data->name }}</a></li> 
					@endforeach
				</ul>
			</div>
		</div>
	</div>

</section>

<!-- Featured And All Jobs -->

<section class="jobs sec-pad">

	<div class="container"> 
		<div class="feature__recent_job">

			<ul class="nav nav-tabs" id="myTab" role="tablist">

				<li class="nav-item">

					<a class="nav-link active" id="featured-jobs-tab" data-toggle="tab" href="#featured-jobs"

						role="tab" aria-controls="featured-jobs" aria-selected="true">Featured Jobs</a>

				</li>

				<li class="nav-item">

					<a class="nav-link" id="recent-jobs-tab" data-toggle="tab" href="#recent-jobs" role="tab"

						aria-controls="recent-jobs" aria-selected="false">Recent Jobs</a>

				</li>

			</ul>

		</div>





		<div class="tab-content" id="myTabContent">

			<div class="tab-pane fade show active" id="featured-jobs" role="tabpanel"

				aria-labelledby="featured-jobs-tab">

				<div class="row mt-4">



					@foreach ($featured_jobs as $single_job)

					<div class="col-md-6">

						@include('frontend.pages.partials.single-job-search')

					</div><!-- End Single Item -->

					@endforeach



				</div>

			</div>

			<div class="tab-pane fade" id="recent-jobs" role="tabpanel" aria-labelledby="recent-jobs-tab">

				<div class="row mt-4">

					@foreach ($recent_jobs as $single_job)

					<div class="col-md-6">

						@include('frontend.pages.partials.single-job-search')

					</div><!-- End Single Item -->

					@endforeach



				</div>

			</div>

		</div>
 
	</div>

</section> 

@endsection 

@section('scripts') 

<!-- Client Review owl Carousel -->

<script>

	$('.owl-carousel').owlCarousel({

		loop:true,

		margin:10,

		// nav:true,

		items: 2,

		responsive:{

			0:{

				items:1

			},

			600:{

				items:2

			},

			1000:{

				items:2

			}

		}

	});

	

	

</script>

<!-- Client Review owl Carousel -->

@endsection