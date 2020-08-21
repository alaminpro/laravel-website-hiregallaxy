@extends('frontend.layouts.master')



@section('title')

Posted Jobs | {{ App\Models\Setting::first()->site_title }}

@endsection



@section('stylesheets')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

<style type="text/css">

	.mb-4{

		margin-bottom: 4px;

	}

</style>

@endsection



@php

$_filter = request()->filter ?? '';

@endphp



@section('content')

<section class="employer-page sec-pad pt-0">

	<div class="container">

		<div class="row mt-4">

			<div class="col-md-12">

				<div class="row mb-4">

					<div class="col-md-3">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.jobs.posted') }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-primary">

								{{ $user_jobs_count }} Total Jobs

							</h6>

						</div>

					</div>

					<div class="col-md-3">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.jobs.listed', 'Live') }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-success">

								@php

									$timezone = date_default_timezone_get();

									$date = date('Y/m/d H:i:s');

									$getActiveJobs = \App\Models\Job::where('user_id',$user->id)->where( 'deadline', '>', $date)->get();

								@endphp

								{{ $getActiveJobs->count() }} Live Jobs

							</h6>

						</div>

					</div>

					<div class="col-md-3">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.jobs.listed', 'In-progress') }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-danger">

								@php

									$timezone = date_default_timezone_get();

									$date = date('Y/m/d H:i:s');

									$getInProgressJobs = \App\Models\Job::where('user_id',$user->id)->where( 'deadline', '<', $date)->where('archived',0)->get();

								@endphp

								{{ $getInProgressJobs->count() }} In-progress Jobs

							</h6>

						</div>

					</div>

					<div class="col-md-3">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.jobs.listed', 'Archived') }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-danger">

								@php

									$timezone = date_default_timezone_get();

									$date = date('Y/m/d H:i:s');

									$getArchivedJobs = \App\Models\Job::where('user_id',$user->id)->where('archived',1)->get();

								@endphp

								{{ $getArchivedJobs->count() }} Archived Jobs

							</h6>

						</div>

					</div>

				</div>

				<!-- <div class="row">

					<div class="col-md-4">

						<form action="">

							<div class="form-group">

								<select class="form-control" name="filter" onchange="submit()">

									<option value="" {{$_filter=='' ? 'selected' : ''}}>Filter Status: View All</option>

									<option value="active" {{$_filter=='active' ? 'selected' : ''}}>Active</option>

									<option value="inactive" {{$_filter=='inactive' ? 'selected' : ''}}>Inactive</option>

								</select>

							</div>

						</form>

					</div>

				</div> -->

				<div class="employer-detail-main">

					<h5 class="text-theme">

						Posted Jobs

					</h5>

					<!-- @foreach ($jobs as  $key => $single_job)

					@include('frontend.pages.partials.single-job-search')

					@endforeach -->

<!-- ==========================================================================================================================================
		Data table code for posted jobs
	===========================================================================================================================================
 -->					

 					<hr>
					<div class="table-responsive">
					<table class="table table-hover table-striped col-sm-12" id="dataTable" style="font-size: 13px !important">

						<thead>

							<th style="padding:5px 22px 10px 6px !important">#</th>

							<th style="padding:5px 22px 10px 6px !important">Job Title</th>

							<th style="padding:5px 22px 10px 6px !important">Company/Project</th>

							<th style="padding:5px 22px 10px 6px !important">Job Locations</th>

							<th style="padding:5px 22px 10px 6px !important">Job Posted Date</th>

							<th style="padding:5px 22px 10px 6px !important">Job Deadline Date</th>*

							<th style="padding:5px 22px 10px 6px !important">Job Archieved Date</th>

							<th style="padding:5px 22px 10px 6px !important">Status</th>

							<th style="padding:5px 22px 10px 6px !important">Actions</th>

						</thead>

						<tbody>

							@php
								$i = 1;
							@endphp
							
							@foreach ($jobs as  $key => $single_job)

							<tr>

								<td> {{ $i }} </td>

								<td>

									<p class="pointer" onclick="location.href='{{ route('jobs.show', $single_job->slug) }}'">
										{{ $single_job->title }}
									</p>

								</td>

								<td>
									@php
									$company = App\Models\Company::where('id', $single_job->company_id)->first()
								@endphp
								{{ $company ? $company->name : '---'  }}
								</td>

								<td>
									{{ $single_job->country->name }}
								</td>

								<td>
									{{ $single_job->created_at }}
								</td>

								<td>
									{{ $single_job->deadline }}
								</td>

								<td>
									{{ $single_job->archived_at != null ?  $single_job->archived_at : 'Not Archived' }}
								</td>

								<td>

									@php

									$flag = 0;

									$timezone = date_default_timezone_get();

									$date = date('Y/m/d H:i:s');

									$getActiveJobs = \App\Models\Job::where('user_id',$user->id)->where( 'deadline', '>', $date)->get();

									foreach($getActiveJobs as $value => $activeJob){
										if($activeJob->id == $single_job->id){
											$flag = 1;
										}
									}

									@endphp

									@if($flag == 1)
										<p style="background-color: #4BB543; padding: 5px 10px; color: #fff;">Active</p>

									@elseif($single_job->archived == 1)
										<p style="background-color: #0000CD; padding: 5px 10px; color: #fff;">Archived</p>										
									@else
										<p style="background-color: #8B0000; padding: 5px 10px; color: #fff;">In-Progress</p>
									@endif

									@php

									$flag = 0;

									@endphp

								</td>

								<td>

									<a href="{{ route('jobs.edit', $single_job->slug) }}" class="btn btn-outline-success" title="Edit Job">

										<i class="fa fa-edit"></i>

									</a>

									<a href="{{ route('employers.jobs.applications', $single_job->slug) }}" class="btn btn-outline-yellow"

										title="View All Applications ({{ count($single_job->activities) }})">

										<i class="fa fa-eye"></i>

										<span class="badge badge-danger">{{ count($single_job->activities) }}</span>

									</a>

									<form method="post" action="{{ route('employers.jobs.delete', $single_job->slug) }}" class="ml-1"

										style="display:inline" onsubmit="return confirm('Are you sure to delete the job permanently ?')">

										@csrf

										<button class="btn btn-outline-danger" type="submit" title="Delete Job" style="border-radius: 20px!important;

										padding: 4px 20px!important">

											<i class="fa fa-trash"></i>

										</button>

									</form>

								</td>

							</tr>

							@php
								$i = $i + 1;
							@endphp

							@endforeach

						</tbody>

					</table>
					</div>

<!-- ==========================================================================================================================================
		Code ends
	===========================================================================================================================================
 -->					

					<!-- <div class="mt-3">

						{{ $jobs->appends(request()->query())->links() }}

					</div>

 -->

					@if (count($jobs) == 0)

					<p class="mt-4">

						<span class="alert alert-danger">

							Sorry !! No {{ucwords(request()->filter)}} jobs found !!

						</span>

					</p>

					@endif

				</div>



			</div>

		</div>

</section>

@endsection





@section('scripts')

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script>

$("#dataTable").dataTable();

$(function() {

	$( ".datepicker" ).datepicker({

		dateFormat: 'yy-mm-dd'

	});

});

</script>


@endsection