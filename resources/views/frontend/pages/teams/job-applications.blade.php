@extends('frontend.layouts.master')



@section('title')

Job Application For - {{ $job->title }} | {{ App\Models\Setting::first()->site_title }}

@endsection



@section('stylesheets')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

@endsection



@section('content')

<section class="employer-page sec-pad pt-0">

	<div class="container">

		<div class="row mt-4">

			<div class="col-md-12">

				<!-- code for quick icons -->

				<div class="row mb-2">

					<div class="col-md-2">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.listed', ['slug'=>$job->slug,'status'=>'New']) }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-primary">

								@php

									$new =  \App\Models\JobActivity::where('company_id',$user->id)->where('job_id',$job->id)->where('status','New')->get();

								@endphp

								{{ $new->count() }} New

							</h6>

						</div>

					</div>

					<div class="col-md-2">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.listed', ['slug'=>$job->slug,'status'=>'Shortlisted']) }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-success">

								@php

									$short =  \App\Models\JobActivity::where('company_id',$user->id)->where('job_id',$job->id)->where('status','Shortlisted')->get();

								@endphp

								{{ $short->count() }} Shortlisted

							</h6>

						</div>

					</div>

					<div class="col-md-2">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.listed', ['slug'=>$job->slug,'status'=>'Interview']) }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-danger">

								@php

									$interview =  \App\Models\JobActivity::where('company_id',$user->id)->where('job_id',$job->id)->where('status','Interview')->get();

								@endphp

								{{ $interview->count() }} Interview

							</h6>

						</div>

					</div>

					<div class="col-md-2">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.listed', ['slug'=>$job->slug,'status'=>'Offered']) }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-danger">

								@php

									$offered =  \App\Models\JobActivity::where('company_id',$user->id)->where('job_id',$job->id)->where('status','Offered')->get();

								@endphp

								{{ $offered->count() }} Offered

							</h6>

						</div>

					</div>

					<div class="col-md-2">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.listed', ['slug'=>$job->slug,'status'=>'Hired']) }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-danger">

								@php

									$hired =  \App\Models\JobActivity::where('company_id',$user->id)->where('job_id',$job->id)->where('status','Hired')->get();

								@endphp

								{{ $hired->count() }} Hired

							</h6>

						</div>

					</div>

					<div class="col-md-2">

						<div class="single-dashboard-link card card-default p-3 text-center"

							onclick="location.href='{{ route('employers.listed', ['slug'=>$job->slug,'status'=>'Rejected']) }}'">

							<span class="">

								<i class="fa fa-bell font30"></i>							

							</span>

							<h6 class="text-danger">

								@php

									$rejected =  \App\Models\JobActivity::where('company_id',$user->id)->where('job_id',$job->id)->where('status','Rejected')->get();

								@endphp

								{{ $rejected->count() }} Rejected

							</h6>

						</div>

					</div>

				</div>

				<!-- code for quick icons end -->

				<div class="employer-detail-main">

					<h5 class="text-theme mb-5">

						Applications For - <mark><span class="border-left">{{ $job->title }}</span></mark>

					</h5>

					<table class="table table-striped col-sm-4" style="font-size: 13px !important">
						<thead>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Hired Date</th>
						</thead>
						<tbody>
							<tr>
								<td>{{ $job->created_at }}</td>
								<td>{{ $job->deadline }}</td>
								<td>
									@foreach($applications as $app)
										@if($app->hired_at != null)
											{{ $app->hired_at }}
											@break
										@endif
									@endforeach
								</td>
							</tr>
						</tbody>
					</table>

					<form id="filter_form" action="{{ route('employers.jobs.applications', $job->slug) }}" method="get">

						<button type="button" id="export" class="btn btn-sm btn-info">Export</button>

					</form>

					<hr>
					<div class="table-responsive">
					<table class="table table-hover table-striped col-sm-12" id="dataTable" style="font-size: 13px !important">

						<thead>

							<th style="padding:5px 22px 10px 6px !important">Candidate</th>

							<th style="padding:5px 22px 10px 6px !important">Education</th>

							<th style="padding:5px 22px 10px 6px !important">Experience</th>

							<th style="padding:5px 22px 10px 6px !important">Skill test</th>

							<th style="padding:5px 22px 10px 6px !important">Personality</th>

							<th style="padding:5px 22px 10px 6px !important">Aptitude</th>

							<!-- <th style="padding:5px 22px 10px 6px !important">Expected Salary</th> -->

							<th style="padding:5px 22px 10px 6px !important">CV</th>

							<th style="padding:5px 22px 10px 6px !important">Cover Letter</th>

							<th style="padding:5px 22px 10px 6px !important">Status</th>

							<th style="padding:5px 22px 10px 6px !important">Edit</th>


						</thead>

						<tbody>

							@foreach ($applications as $application)

							<tr>

								<td>

								<img class="d-block text-center" src="{{ App\Helpers\ReturnPathHelper::getUserImage($application->user->id) }}"

								style="width: 30px">



								<a class="text-center" href="#userViewModal{{ $application->id }}" data-toggle="modal" class="text-theme">{{ $application->user->name }}</a>

									<br>

									<span class="text-muted font12">

										Applied {{ $application->created_at->diffForHumans() }}

									</span>

								</td>

								<td> @if(!empty($education)){{$education->certificate_degree_name}} @else --- @endif</td>

								<td> @if(!empty($experience->experience)){{$experience->experience->name}} @else --- @endif</td>



								@php 

								$result = \App\Models\Result::where('job_id', $application->job_id)->where('user_id', $application->user_id)->first();

								@endphp

								@if($result != null) 

								<td>{{ $result->result }}</td>  

								@else

								<td>---</td>

								@endif



								@php 

								$personality_result = \App\Models\PersonalityResult::where('user_id', $application->user_id)->first();

								$personality = \App\Models\Personality::where('title', '=', $personality_result['personality_result'])

								->select('id','sub_title')->first(); 

								@endphp

								@if($personality == null)

								<td>---</td>

								@else 

								<td>{{$personality['sub_title']}}

									<div class="d-flex justify-content-center"> 

										<a href="{{ route('public.personality', $application->user_id)}}" class="mt-1 text-center btn-sm btn btn-outline-yellow"> <i class="fa fa-eye"></i> view</a> 

									</div>

								</td>

								@endif

								@php 

								$apt = \App\Models\AptitudeResult::where('user_id', $application->user_id)->first(); 

								@endphp

								@if($apt == null)

								<td>---</td>

								@else 

								<td>{{$apt['result']}}</td>

								@endif

								<td>

								@if ($application->cv != null)

								<a href="{{ $application->cv }}" target="_blank"><i

									class="fa fa-download"></i> Download</a>

									@else

									--

									@endif

								</td>

								<td>

									<a href="#coverLetterViewModal{{ $application->id }}" data-toggle="modal"

									class="btn btn-outline-yellow btn-sm"><span class="fa fa-eye"></span> View</a>

								</td>

								<td>

									{{ $application->status }}

								</td>

								<td>

									<div class="float-right">

											<a href="#editStatusModal{{ $application->id }}" class="btn btn-outline-secondary"

												data-toggle="modal"><i class="fa fa-edit"></i></a>

										</div>

										<div class="modal fade" id="editStatusModal{{ $application->id }}" tabindex="-1" role="dialog"

											aria-labelledby="exampleModalLabel" aria-hidden="true">

											<div class="modal-dialog modal-sm" role="document">

												<div class="modal-content">

													<div class="modal-header">

														<h5 class="modal-title" id="exampleModalLabel">Edit Status

														</h5>

														<button type="button" class="close" data-dismiss="modal"

															aria-label="Close">

															<span aria-hidden="true">&times;</span>

														</button>

													</div>

													<div class="modal-body" style="text-align: left!important">

														<form

														action="{{ route('employers.applicants.update', $application->id) }}"

														method="post">

														@csrf

														<div class="row">

														<select name="status"

															class="form-control app-edit-field col-md-8" required>

															<option value="New" {{ $application->status == 'New' ? 'selected' : '' }}>New</option>
															<option value="Shortlisted" {{ $application->status == 'Shortlisted' ? 'selected' : '' }}>Shortlisted</option>
															<option value="Interview" {{ $application->status == 'Interview' ? 'selected' : '' }}>Interview</option>
															<option value="Offered" {{ $application->status == 'Offered' ? 'selected' : '' }}>Offered</option>
															<option value="Hired" {{ $application->status == 'Hired' ? 'selected' : '' }}>Hired</option>
															<option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>

														</select>
														<button type="submit" id="submit" name="submit" class="btn btn-primary btn-app col-md-3">Update</button>
														</div>

														</form>

													</div>

												</div>

											</div>

										</div>


									<!--

									=====================================================================================
									-->

								</td>

							</tr>

							<div class="modal animated fadeIn" id="coverLetterViewModal{{ $application->id }}">

								<div class="modal-dialog modal-lg">

									<div class="modal-content">



										<!-- Modal Header -->

										<div class="modal-header">

											<h4 class="modal-title text-theme font22 bold">View Cover Ltter</h4>

											<button type="button" class="close ml-2"

											data-dismiss="modal">&times;</button>

										</div>



										<!-- Modal body -->

										<div class="modal-body pb-5">

											{!! $application->cover_letter !!}

										</div>



									</div>

								</div>

							</div>

							<!--
							================= profile view modal =========================
							-->

							<div class="modal animated fadeIn" id="userViewModal{{ $application->id }}">

								<div class="modal-dialog modal-md">

									<div class="modal-content">



										<!-- Modal Header -->

										<div class="modal-header">

											<h4 class="modal-title text-theme font22 bold">User Profile</h4>

											<button type="button" class="close ml-2"

											data-dismiss="modal">&times;</button>

										</div>



										<!-- Modal body -->

										<div class="modal-body pb-5">

											<div class="row">

												<div class="col-md-3">
													<img class="d-block text-center" src="{{ App\Helpers\ReturnPathHelper::getUserImage($application->user->id) }}" style="max-width: 100% !important;">

												</div>

												<div class="col-md-5">
													<b>Name:</b><br>
													{{ $application->user->name }}
													<br>
													<b>Email:</b><br>
													{{ $application->user->email }}
													<br>
													<b>Applied For:</b><br>
													{{ $job->title }}
												</div>

												<div class="col-md-4">
													<b>Phone No:</b><br>
													@if(!empty($user->phone_no)){{$user->phone_no}} @else --- @endif
													<br>
													<b>Experience:</b><br>
													@if(!empty($experience->experience)){{$experience->experience->name}} @else --- @endif
													<br>
													<b>Working At:</b><br>
													@php

													$exps = $application->user->experiences()->orderBy('is_current_job', 'desc')->get();

													@endphp

													@foreach($exps as $exp)
													<span style="font-size: 12px; opacity: 0.7;">{{ $exp->company_name }}</span>
													<br>
													{{ $exp->job_title }}
													<br>
													<span style="font-size: 12px; opacity: 0.7;">{{ $exp->start_date }} - 
													@if ($exp->is_current_job)

													Present

													@else

													{{ $exp->end_date }}

													@endif
													</span>
													@break
													@endforeach
												</div>

											</div>
											<hr>
											<a href="{{ route('candidates.show', $application->user->username) }}" class="btn btn-primary pull-right" target="_blank">View Complete Profile</a>
										</div>



									</div>

								</div>

							</div>

							<!--
							================= profile view end ===========================
							-->

							@endforeach

						</tbody>

					</table>
					</div>

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



$('#export').click(function(){

	$('<input>').attr({

	    type: 'hidden',

	    id: 'foo',

	    name: 'export'

	}).appendTo('form');

	$('#filter_form').submit();

});

</script>

@endsection

