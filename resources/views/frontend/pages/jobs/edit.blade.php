@extends('frontend.layouts.master')

@section('title')
Edit Job - {{ $job->title }} | {{ App\Models\Setting::first()->site_title }}
@endsection


@section('stylesheets')
<style>
	textarea {
		border: none;
	}

	.cke_editable {
		padding: 5px;
		border: 0px !important;
		border-bottom: 1px solid #dfdfdf !important;
		//margin-top: -18px;
	}

	div#searchTemplateArea {
		border: 1px solid #dfdfdf;
		padding: 10px;
		margin-top: -17px;
		overflow-y: scroll;
		max-height: 240px;
		position: absolute;
		z-index: 10000;
		background: #eee;
		width: 405px;
	}

	div#searchTemplateArea a {
		border-bottom: 1px solid #9e9e9e57 !important;
		display: block;
		padding: 5px;
		transition: .3s;
	}

	div#searchTemplateArea a:hover {
		background: #6b68e7;
		color: #FFF;
	}

	#title:focus,
	#title:active {
		box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0) !important;
	}

	.post-job-page .form-row strong {
		padding-left: 7px;
	}
</style>
@endsection


@section('content')
<section class="post-job-page sec-pad">
	@php
	$enable_editing = App\Models\Setting::first()->enable_job_editing;
	@endphp

	<div class="container">
		{{--  <div class="job-post-form">  --}}
		<div class="">
			<div class="row justify-content-center">
				<div class="col-11">

					{{--  <h5 class="text-theme bold mb-3">Post a new job</h5>  --}}
					<form action="{{ route('jobs.update', $job->slug) }}" method="post" enctype="multipart/form-data"
						data-parsley-validate>
						@csrf

						<div class="card card-body p-0 pt-2 pb-2">
							<div class="row form-group">
								<div class="col-sm-12">
									<div class="row form-group justify-content-center">
										<div class="col-md-5">
											<input type="search" autocomplete="off"
												class="text-center text-theme form-control border-0 border-bottom mb-3"
												id="title" name="title" placeholder="Job Title"
												style="border-bottom: 1px solid #5553b7!important;"
												value="{{ !is_null($job->template) ? $job->template->name : '' }}">
											<div id="searchTemplateArea"></div>
											<input type="hidden" name="template_id" id="template_id"
												value="{{ $job->template_id }}">
										</div>
									</div>
								</div>
							</div>


							<div class="form-row">
								<div class="col-md-12 form-group">
									<div class="row">
										<div class="col-md-12">
											<strong>Job Summary</strong>
											@if ($enable_editing)
											<textarea name="job_summery" id="job_summery" rows="3"
												class="template form-control">{!! $job->job_summery !!}</textarea>
											@else
											<div id="job_summery" class="ml-2">{!! $job->job_summery !!}</div>
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-12 form-group">
									<div class="row">
										<div class="col-md-12">
											<strong>Responsibilities & Duties</strong>
											<textarea name="responsibilities" id="responsibilities"
												name="responsibilities" rows="3"
												class="template form-control">{!! $job->responsibilities !!}</textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-12 form-group">
									<div class="row">
										<div class="col-md-12">
											<strong>Qualification</strong>
											<textarea name="qualification" id="qualification" name="qualification"
												rows="3"
												class="template form-control">{!! $job->qualification !!}</textarea>
										</div>
									</div>
								</div>
								<div class="col-md-12 form-group">
									<div class="row">
										<div class="col-md-12">
											<strong>Certification</strong>
											<textarea name="certification" id="certification" name="certification"
												rows="3"
												class="template form-control">{!! $job->certification !!}</textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-12 form-group">
									<div class="row">
										<div class="col-md-12">
											<strong>Experience</strong>
											<textarea name="experience" id="experience" name="experience" rows="3"
												class="template form-control">{!! $job->experience !!}</textarea>
										</div>
									</div>
								</div>
								<div class="col-md-12 form-group" style="margin-bottom: -9px;">
									<div class="row">
										<div class="col-md-12">
											<strong>About Company</strong>
											<textarea name="about_company" id="about_company" name="about_company"
												rows="3"
												class="template form-control">{!! $job->about_company !!}</textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card card-body p-2" style="margin-top: 50px">
							<div class="row form-group">
								<div class="col-sm-6">
									<label for="monthly_salary">Salary <span class="required">*</span> <span
											class="text-muted font12">(Monthly Salary)</span>

										<input type="checkbox" name="is_salary_negotiable" id="is_salary_negotiable"
											value="1" class="ml-3" {{ $job->is_salary_negotiable ? 'checked' : '' }}>
										<label for="is_salary_negotiable">(Salary Negotiable)</label>
									</label>

									<div class="row">
										<div class="col-8">
											<input type="number" id="monthly_salary" name="monthly_salary"
												class="form-control" placeholder="Write your expected salary"
												{{ !$job->is_salary_negotiable ? 'required' : 'disabled' }} min="1"
												value="{{ $job->monthly_salary }}">
										</div>
										<div class="col-4 pl-0">
											<select name="salary_currency" class="form-control" id="salary_currency"
												{{ !$job->is_salary_negotiable ? 'required' : 'disabled' }}>
												@foreach ($currencies as $cur)
												<option value="{{ $cur->id }}"
													{{ $cur->id == $job->salary_currency ? 'selected' : '' }}>
													{{ $cur->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>

								<div class="col-sm-6">
									<label for="email">Email <span class="required">*</span>
									</label>
									<input type="email" name="email" class="form-control" id="email"
										placeholder="Write job response email" value="{{ $job->email }}" required>
								</div>
							</div>

							<div class="row form-group">
								<div class="col-sm-6">
									<div class="row form-group">
										<input type="hidden" class="form-control" name="location" id="location"
											placeholder="Company/Job Location" value="@if (Auth::check())@if (Auth::user()->is_company){{ Auth::user()->location->street_address }}@endif
											@endif">
										<div class="col-12">
											<label for="location">City <span class="required">*</span></label>
											<select name="country" id="country" class="form-control" required>
												<option value="">Select a city</option>
												@foreach ($countries as $country)
												<option value="{{ $country->id }}"
													{{ $country->id == $job->country->id ? 'selected' : '' }}>
													{{ $country->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>

								<div class="col-sm-6">
									<label for="type_id">Job Type <span class="required">*</span>
									</label>
									<select name="type_id" id="type_id" class="form-control" required>
										<option value="">Select One</option>
										@foreach ($job_types as $j_type)
										<option value="{{ $j_type->id }}"
											{{ $job->type_id ==  $j_type->id ? 'selected' : ''  }}>{{ $j_type->name }}
										</option>
										@endforeach
									</select>
								</div>

							</div>
							<div class="row form-group">
								<div class="col-sm-4">
									<label for="apply_type_id">Job Nature <span class="required">*</span>
									</label>
									<select name="apply_type_id" id="apply_type_id" class="form-control" required>
										<option value="">Select One</option>
										@foreach ($job_apply_types as $apply_type)
										<option value="{{ $apply_type->id }}"
											{{ $job->apply_type_id == $apply_type->id ? 'selected' : '' }}>
											{{ $apply_type->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-4">
									<label for="experience_id">Experience <span class="required">*</span>
									</label>
									<select name="experience_id" id="experience_id" class="form-control" required>
										<option value="">Select One</option>
										@foreach ($job_experiences as $exp)
										<option value="{{ $exp->id }}"
											{{ $job->experience_id == $exp->id ? 'selected' : '' }}>{{ $exp->name }}
										</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-4">
									<label for="deadline">Application Deadline <span class="required">*</span>
									</label>
									<input type="text" autocomplete="off" name="deadline" class="form-control"
										id="deadline" placeholder="Write application deadline" required
										value="{{ $job_deadline }}">
								</div>
							</div>


						</div>

						<div class="form-group mt-2">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="termsCheck" required checked>
								<label class="form-check-label ml-3" for="termsCheck">
									Accept our <a target="_blank" href="{{ route('terms') }}" class="text-yellow">Terms
										and
										Condition</a> and <a target="_blank" href="{{ route('privacy') }}"
										class="text-yellow">Privacy
										Policy</a>
								</label>
							</div>
						</div>

						<button type="submit" class="btn apply-now-button pt-2 pb-2 font18">
							<i class="fa fa-check"></i> Save Changes
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection


@section('scripts')

<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style>
	.select2-container .select2-selection--single {
		height: 35px;
	}

	#s2id_title .select2-default {
		color: green !important;
	}

	.select2-container {
		text-align: center;
	}

	.select2-container--default .select2-selection--single {
		border: none;
		border-bottom: 1px solid #5553b7;
		border-radius: 0px;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		color: #5553b7;
		font-weight: bold;
	}
</style>
<script>
	$(".select2-title").select2({
		placeholder: "Job Title",
		allowClear: true
	});
	$(this).siblings('.select2-container').find('.select2-selection__placeholder').css('color', '#5553b7');

</script>

@include('frontend.pages.jobs.partials.post-job-script-old');

<script>
	$(function() {
		$( "#deadline" ).datepicker();
	});

	@if($enable_editing)
		var pluginsTested = 'codesample autoresize code print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern';
		
		tinymce.init({
			selector:'#job_summery',
			plugins: pluginsTested,
			autoresize_bottom_margin: 0,
			image_advtab: true,
			menubar:false,
		  });
		
		tinymce.init({
			selector:'#responsibilities',
			plugins: pluginsTested,
			autoresize_bottom_margin: 0,
			image_advtab: true,
			menubar:false,
		  });
		
		tinymce.init({
			selector:'#qualification',
			plugins: pluginsTested,
			autoresize_bottom_margin: 0,
			image_advtab: true,
			menubar:false,
		  });
		
		tinymce.init({
			selector:'#certification',
			plugins: pluginsTested,
			autoresize_bottom_margin: 0,
			image_advtab: true,
			menubar:false,
		  });
		
		tinymce.init({
			selector:'#experience',
			plugins: pluginsTested,
			autoresize_bottom_margin: 0,
			image_advtab: true,
			menubar:false,
		  });
		
		tinymce.init({
			selector:'#about_company',
			plugins: pluginsTested,
			autoresize_bottom_margin: 0,
			image_advtab: true,
			menubar:false,
		  });
	@endif

	$("#is_salary_negotiable").change(function(){

		var monthly_salary = $("#monthly_salary");
		var salary_currency = $("#salary_currency");

		if($(this).is(':checked')){
			monthly_salary.removeAttr('required');
			monthly_salary.attr('disabled', 'true');

			salary_currency.removeAttr('required');
			salary_currency.attr('disabled', 'true');
		}else{
			monthly_salary.removeAttr('disabled');
			monthly_salary.attr('required', 'true');

			salary_currency.removeAttr('disabled');
			salary_currency.attr('required', 'true');
		}
	});

	// Select on the job title and fill the fields from the templates

	var area = $("#searchTemplateArea");
	area.addClass('hidden');
	
	$("#title").on('input', function(){
		var search = $("#title").val();
		if(search.length > 0){
			var url = "{{ Url('/') }}"+"/api/templates/"+search;
			var htmlValue = "";
	
			$.get(url).done(function( data ) {
				// console.log(data.templates);
				if(data.templates.length > 0){
					area.removeClass('hidden');
					for(var i=0; i < data.templates.length; i++){
						htmlValue += "<div class='item'><a onClick='selectTemplate("+data.templates[i].id+")' class='pointer border-bottom'>"+data.templates[i].name+"</a></div>";
					}
					area.html(htmlValue);
				}else{
					data = [];
					area.html(htmlValue);
					area.addClass('hidden');
				}
				
				
			});
		}else{
			area.addClass('hidden');
		}

	});

	function selectTemplate(id){
		var area = $("#searchTemplateArea");
		var search = $("#title");

		area.addClass('hidden');
		$("#template_id").val(id);

		$.post( "{{ route('api.getTemplate') }}", { template_id: id } )
		.done(function( data ) {
			data = JSON.parse(data);
			search.val(data.template.name);

			$('#responsibilities').html('');
			$('#job_summery').html('');
			$('#qualification').html('');
			$('#certification').html('');
			$('#experience').html('');
			$('#about_company').html('');

			@if($enable_editing)
				tinymce.get('job_summery').setContent(data.template.job_summery);
				tinymce.get('responsibilities').setContent(data.template.responsibilities);
				tinymce.get('qualification').setContent(data.template.qualification);
				tinymce.get('certification').setContent(data.template.certification);
				tinymce.get('experience').setContent(data.template.experience);
				tinymce.get('about_company').setContent(data.template.about_company);
			@endif

			  $('#responsibilities').html(data.template.responsibilities);
			  $('#job_summery').html(data.template.job_summery);
			  $('#qualification').html(data.template.qualification);
			  $('#certification').html(data.template.certification);
			  $('#experience').html(data.template.experience);
			  $('#about_company').html(data.template.about_company);
		});
	}
</script>
@endsection