@extends('frontend.layouts.master')
@section('title')
{{ App\Models\Setting::first()->site_title }} | home
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
 
<section class="bg-white py-5">
	<div class="container">
		<div class="row ">
			<div class="col-lg-2 d-flex justify-content-center d-md-block">
				<img src="{{ asset('images/img-01.png') }}" alt="img-01" width="150">
			</div>
			<div class="col-lg-10">
			 <p class=" home__new_text text-center text-md-left">The problem of using expensive software to make an eye catching CV is solved. Now leave all these worry, you can crate a professional CV in three steps and share to unlimited recruiters for free.
			</p>
			<div class="row">
				<div class="col-lg-8  d-flex justify-content-center d-md-block">
					<ul class="home__ul_list">
						<li>Register</li>
						<li>Fill details</li>
						<li>Generate pdf file</li>
					</ul>
				</div>
				<div class="col-lg-4 d-flex justify-content-center d-md-block">
					<img src="{{ asset('images/img-02.png') }}" alt="img-2" width="250">
				</div>
			</div>
			<div class="row py-2 align-items-center">
				<div class="col-lg-6">
					<div class="row align-items-start">
						<div class="col-lg-4 d-flex justify-content-center d-md-block">
							<img src="{{ asset('images/img-03.png') }}" alt="img-2" width="150">
						</div>
						<div class="col-lg-8">
							<p class="home_text_personality text-center text-md-left mt-4" style="font-size: 20px">Take online personality test for free. When you apply for a job , the details will be shared to recruiters for free!!
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row align-items-start">
						<div class="col-lg-4 d-flex justify-content-center d-md-block">
							<img src="{{ asset('images/img-04.png') }}" alt="img-2" width="150">
						</div>
						<div class="col-lg-8">
							<p class="home_text_personality" style="font-size: 20px">Take online aptitude test for free. When you apply for a job , the details will be shared to recruiters for free!!
	
							</p>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		
	</div>
</section>
 
<section class="bg-white py-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 d-flex justify-content-center d-md-block">
				<img src="{{ asset('images/img-06.png') }}" alt="img-01" width="150">
			</div>
			<div class="col-lg-10">
			 <p class=" home__new_text text-center text-md-left">The problem of screening hundreds of candidates is solved. Received <span class="text-danger font-weight-bold">PRESCREENED</span> candidate to your inbox. Our simple process of screening candidate is very effective. Joblrs automatic candidate screening process perform following tests online and provide employer with top candidate.

			</p>
			<div class="row"> 
				<div class="col-lg-6 d-flex justify-content-center d-md-block">
					<ul class="home__ul_list">
						<li>Aptitude test 
						</li>
						<li>Personality test 
						</li>
						<li>Job skill test 
						</li>
					</ul>
				</div>
				<div class="col-lg-6 d-flex justify-content-center d-md-block">
					<img src="{{ asset('images/img-07.png') }}" alt="img-2" class="img-fluid">
				</div>
			</div>
			</div> 
		</div> 	
	</div>
</section>

<section class="bg-white py-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 d-flex justify-content-center d-md-block">
				<img src="{{ asset('images/img-05.png') }}" alt="img-01" width="150">
			</div>
			<div class="col-lg-10">
			 <p class=" home__new_text text-center text-md-left">The problem of managing multiple recruitment team at different location is <span class="font-weight-bold" style="text-decoration: underline">no more a point of worry</span> for recruitment agency. In Joblrs platform recruiter can add multiple team and monitor their performance.    
 				</p>
				<div class="row">
					<div class="col-lg-6 d-flex justify-content-center d-md-block"><img src="{{ asset('images/img-09.png') }}" alt="img-01" class="img-fluid"></div>
					<div class="col-lg-6 d-flex justify-content-center d-md-block"><img src="{{ asset('images/img-08.png') }}" alt="img-02" class="img-fluid"></div> 
				</div>
			</div>
		</div> 	
	</div>
</section>


@endsection 

@section('scripts') 

 
@endsection