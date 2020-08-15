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
			<div class="col-md-8">
				<div class="employer-detail-main">
					<h5 class="text-theme mb-5">
						Applications For - <mark><span class="border-left">{{ $job->title }}</span></mark>
					</h5>
					<table class="table table-hover table-striped" id="dataTable">
						<thead>

							<th>Candidate</th>
							<th>Expected Salary</th>
							<th>CV</th>
							<th>Cover Letter</th>
						</thead>
						<tbody>
							@foreach ($applications as $application)
							<tr>

								<td>
									<img src="{{ App\Helpers\ReturnPathHelper::getUserImage($application->user->id) }}"
										style="width: 60px">

									<a href="{{ route('candidates.show', $application->user->username) }}"
										target="_blank" class="text-theme">{{ $application->user->name }}</a>
									<br>
									<span class="text-muted font12">
										Applied {{ $application->created_at->diffForHumans() }}
									</span>
								</td>
								<td>
									@if ($application->is_salary_negotiable)
									Negotiable
									@else
									{{ round($application->expected_salary, 0) }}

									{{ !is_null($job->currency) ? $job->currency->name : 'USD' }}
									@endif
								</td>
								<td>
									@if ($application->cv != null)
									<!--<a href="{{ asset('public/files/cv/'.$application->cv) }}"><i-->
									<!--		class="fa fa-download"></i> Download</a>-->
									<a href="{{ $application->cv }}" target="_blank"><i
											class="fa fa-download"></i> Download</a>
									@else
									--
									@endif
								</td>
								<td>
									<a href="#coverLetterViewModal{{ $application->id }}" data-toggle="modal"
										class="btn btn-outline-yellow"><span class="fa fa-eye"></span> View</a>
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
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
			<div class="col-md-4">
				@include('frontend.pages.partials.employers-sidebar')
			</div>
		</div>
</section>
@endsection


@section('scripts')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
	$("#dataTable").dataTable();
</script>
@endsection