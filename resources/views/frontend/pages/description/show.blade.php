@extends('frontend.layouts.master')



@section('title')

Job Description - {{ $template->name }} | {{ App\Models\Setting::first()->site_title }}

@endsection



@section('stylesheets')



@endsection



@section('content')

<section class="employer-page sec-pad">

	<div class="container"> 
        <div class="single-job-short single-template  px-4"> 
                <table class="table table-bordered table-responsive">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{ $template->name }}</td>
                    </tr>
                    <tr>
                        <td>Categoriy</td>
                        <td>:</td>
                        <td>{{ $template->category->name }}</td>
                    </tr>
                    <tr>
                        <td>Job Summery</td>
                        <td>:</td>
                        <td>{!! $template->job_summery  !!}</td>
                    </tr>
                    <tr>
                        <td>Responsibilities</td>
                        <td>:</td>
                        <td>{!! $template->responsibilities  !!}</td>
                    </tr>
                    <tr>
                        <td>Job Summery</td>
                        <td>:</td>
                        <td>{!! $template->job_summery  !!}</td>
                    </tr>
                    <tr>
                        <td>Qualification</td>
                        <td>:</td>
                        <td>{!! $template->qualification  !!}</td>
                    </tr>
                    <tr>
                        <td>Certification</td>
                        <td>:</td>
                        <td>{!! $template->certification  !!}</td>
                    </tr>
                    <tr>
                        <td>About Company</td>
                        <td>:</td>
                        <td>{!! $template->about_company  !!}</td>
                    </tr>
                </table>
        </div> 
	</div>

</section>

@endsection



 