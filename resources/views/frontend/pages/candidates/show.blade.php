@extends('frontend.layouts.master')

@section('title')
Candidate Details | {{ App\Models\Setting::first()->site_title }}
@endsection


@section('stylesheets')

@endsection


@section('content')
<section class="employer-page sec-pad">
	<div class="container">

		<div class="row mt-2">
			<div class="col-md-8">
				<div class="employer-detail-main">
					<h5 class="text-theme float-left">
						About {{ $user->name }}
					</h5>
					@if (Auth::check() && Auth::id() == $user->id)
					<div class="float-right">
						<a href="#editAboutModal" class="btn btn-outline-secondary" data-toggle="modal"><i
								class="fa fa-edit"></i></a>
					</div>

					<div class="modal fade" id="editAboutModal" tabindex="-1" role="dialog"
						aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">About Yourself</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="{{ route('candidates.about.update', $user->id) }}" method="post"
										data-parsley-validate>
										@csrf
										<div class="row form-group">
											<div class="col-md-12">
												<label for="about">About <span class="required">*</span></label>
												<textarea name="about" id="about" class="form-control" rows="3"
													required>{{ $user->about }}</textarea>
											</div>
										</div>

										<p class="text-left">
											<button type="submit" class="btn btn-outline-success"><i
													class="fa fa-check"></i> Save</button>
										</p>
									</form>
								</div>
							</div>
						</div>
					</div>

					@endif

					<div class="clearfix"></div>
					<div class=" mt-3">
						<!-- User Portfolio text -->
						{!! $user->about !!}
					</div>

					<!-- Work Experience -->
					<div class="mt-5">
						<h5 class="text-theme text-uppercase float-left">
							<i class="fa fa-shopping-bag"></i> Work Experience
						</h5>
						@if (Auth::check() && Auth::id() == $user->id)
						<div class="float-right">
							<a href="#addWorkExperienceModal" class="btn btn-yellow" data-toggle="modal">
								<i class="fa fa-plus-circle" aria-hidden="true"></i>
							</a>
						</div>
						@endif
						<div class="clearfix"></div>

						@if (Auth::check() && Auth::id() == $user->id)

						<!-- Add Work Experience Modal -->
						<div class="modal fade" id="addWorkExperienceModal" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add New Experience</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('candidates.experience.store') }}" method="post"
											data-parsley-validate>
											@csrf
											<div class="row form-group">
												<div class="col-md-6">
													<label for="job_title">Job Title <span
															class="required">*</span></label>
													<input type="text" class="form-control" name="job_title"
														id="job_title" placeholder="Enter Job Title" required>
												</div>
												<div class="col-md-6">
													<label for="company_name">Company Name <span
															class="required">*</span></label>
													<input type="text" class="form-control" name="company_name"
														id="company_name" placeholder="Enter Company Name" required>
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-6">
													<label for="start_date">Job Start Date <span
															class="required">*</span></label>
													<input type="date" class="form-control" name="start_date"
														id="start_date" placeholder="Enter Job Start Date" required>
												</div>
												<div class="col-md-6">
													<label for="end_date">Job End
														<input type="checkbox" name="is_current_job" id="is_current_job"
															value="1" class="ml-3" />
														<label class="font12 text-muted" for="is_current_job">
															Current Job
														</label>
													</label>
													<input type="date" class="form-control" name="end_date"
														id="end_date" placeholder="Enter Job End Date">
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-4">
													<label for="job_location_country">Job City <span
															class="required">*</span></label>
													<select name="job_location_country" id="job_location_country"
														class="form-control" required>
														<option value="">Choose Job City</option>
														@foreach (App\Models\Country::orderBy('name', 'asc')->get() as
														$country)
														<option value="{{ $country->name }}">{{ $country->name }}
														</option>
														@endforeach
													</select>
												</div>

												<div class="col-md-4">
													<label for="job_location_state">Job State</label>
													<input type="text" class="form-control" name="job_location_state"
														id="job_location_state" placeholder="Enter Job State">
												</div>
												<div class="col-md-4">
													<label for="job_location_city">Country</label>
													<input type="text" class="form-control" name="job_location_city"
														id="job_location_city" placeholder="Enter Job Country">
												</div>

											</div>

											<div class="row form-group">
												<div class="col-md-12">
													<label for="start_date">Job Details <span
															class="required">*</span></label>
													<textarea name="description" id="description" class="form-control"
														rows="3" required></textarea>
												</div>
											</div>

											<p class="text-left">
												<button type="submit" class="btn btn-outline-success"><i
														class="fa fa-check"></i> Save</button>
											</p>
										</form>
									</div>
								</div>
							</div>
						</div>
						@endif

						<div class="mt-4">
							@php
							$user_work_experiences = $user->experiences()->orderBy('is_current_job',
							'desc')->orderBy('end_date', 'desc')->get();
							@endphp
							@foreach ($user_work_experiences as $exp)
							<div class="single-work-experience">
								<i class="fa fa-circle-o experience-circle font24 text-yellow float-left"></i>
								<span class="hr-span"></span>
								<div class="work-history float-left ml-3">
									<span>
										<span class="text-yellow bold font16">{{ $exp->company_name }} /</span>
										<span class="text-muted"> {{ $exp->start_date }} -
											@if ($exp->is_current_job)
											Present
											@else
											{{ $exp->end_date }}
											@endif
										</span>
									</span>
									<p class="font-weight-bold text-theme font18">
										{{ $exp->job_title }}
									</p>

									<p class="mt-1">
										{{ $exp->description }}
									</p>
								</div>
								@if (Auth::check() && Auth::id() == $user->id)
								<div class="float-right">
									<div class="dropdown">
										<i class="btn btn-edit mtminus40px fa fa-ellipsis-h" id="expMenu"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
										<div class="dropdown-menu" aria-labelledby="expMenu">
											<a class="dropdown-item" href="#editExperienceModal{{ $exp->id }}"
												data-toggle="modal">
												<i class="fa fa-edit"></i> Edit
											</a>
											<a class="dropdown-item" href="#deleteExperienceModal{{ $exp->id }}"
												data-toggle="modal">
												<i class="fa fa-trash"></i> Delete
											</a>
										</div>
									</div>

									<!-- Edit Experience Modal -->
									<div class="modal fade" id="editExperienceModal{{ $exp->id }}" tabindex="-1"
										role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Edit Experience</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="{{ route('candidates.experience.update', $exp->id) }}"
														method="post" data-parsley-validate>
														@csrf
														<div class="row form-group">
															<div class="col-md-6">
																<label for="job_title">Job Title <span
																		class="required">*</span></label>
																<input type="text" class="form-control" name="job_title"
																	id="job_title" placeholder="Enter Job Title"
																	value="{{ $exp->job_title }}" required>
															</div>
															<div class="col-md-6">
																<label for="company_name">Company Name <span
																		class="required">*</span></label>
																<input type="text" class="form-control"
																	name="company_name" id="company_name"
																	placeholder="Enter Company Name"
																	value="{{ $exp->company_name }}" required>
															</div>
														</div>

														<div class="row form-group">
															<div class="col-md-6">
																<label for="start_date">Job Start Date <span
																		class="required">*</span></label>
																<input type="date" class="form-control"
																	name="start_date" id="start_date"
																	placeholder="Enter Job Start Date"
																	value="{{ $exp->start_date }}" required>
															</div>
															<div class="col-md-6">
																<label for="end_date">Job End
																	<input type="checkbox" name="is_current_job"
																		id="is_current_job" value="1" class="ml-3"
																		{{ $exp->is_current_job ? 'checked' : '' }} />
																	<label class="font12 text-muted"
																		for="is_current_job">
																		Current Job
																	</label>
																</label>
																<input type="date" class="form-control" name="end_date"
																	id="end_date" placeholder="Enter Job End Date"
																	value="{{ $exp->end_date }}">
															</div>
														</div>

														<div class="row form-group">
															<div class="col-md-4">
																<label for="job_location_city">Job City</label>
																<input type="text" class="form-control"
																	name="job_location_city" id="job_location_city"
																	placeholder="Enter Job City"
																	value="{{ $exp->job_location_city }}">
															</div>
															<div class="col-md-4">
																<label for="job_location_state">Job State</label>
																<input type="text" class="form-control"
																	name="job_location_state" id="job_location_state"
																	placeholder="Enter Job State"
																	value="{{ $exp->job_location_state }}">
															</div>
															<div class="col-md-4">
																<label for="job_location_country">Job Country <span
																		class="required">*</span></label>
																<select name="job_location_country"
																	id="job_location_country" class="form-control"
																	required>
																	<option value="">Choose Job Country</option>
																	@foreach (App\Models\Country::orderBy('name',
																	'asc')->get() as $country)
																	<option value="{{ $country->name }}"
																		{{ $country->name == $exp->job_location_country ? 'selected' : '' }}>
																		{{ $country->name }}</option>
																	@endforeach
																</select>
															</div>

														</div>

														<div class="row form-group">
															<div class="col-md-12">
																<label for="start_date">Job Details <span
																		class="required">*</span></label>
																<textarea name="description" id="description"
																	class="form-control" rows="3"
																	required>{{ $exp->description }}</textarea>
															</div>
														</div>

														<p class="text-left">
															<button type="submit" class="btn btn-outline-success"><i
																	class="fa fa-check"></i> Update</button>
														</p>
													</form>
												</div>
											</div>
										</div>
									</div>

									<!-- Delete Experience Modal -->
									<div class="modal fade" id="deleteExperienceModal{{ $exp->id }}" tabindex="-1"
										role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Delete Experience
													</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="{{ route('candidates.experience.delete', $exp->id) }}"
														method="post" data-parsley-validate>
														@csrf
														<p>
															Are you sure to delete the eperience -
															"<mark>{{ $exp->job_title }}</mark>"
														</p>

														<p class="text-center">
															<button type="submit" class="btn btn-outline-success"><i
																	class="fa fa-check"></i> Confirm Delete</button>
														</p>
													</form>
												</div>
											</div>
										</div>
									</div>

								</div>
								@endif
								<div class="clearfix"></div>
							</div> <!-- End Single Work Experience -->
							@endforeach
						</div>
					</div>

					<!-- Education -->
					<div class="mt-5">
						<h5 class="text-theme text-uppercase float-left">
							<i class="fa fa-graduation-cap"></i> Educations
						</h5>
						@if (Auth::check() && Auth::id() == $user->id)
						<div class="float-right">
							<a href="#addUserQualificationeModal" class="btn btn-yellow" data-toggle="modal"
								title="Add New Qualification">
								<i class="fa fa-plus-circle" aria-hidden="true"></i>
							</a>
						</div>
						@endif
						<div class="clearfix"></div>

						@if (Auth::check() && Auth::id() == $user->id)

						<div class="modal fade" id="addUserQualificationeModal" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add New Qualification</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('candidates.education.store') }}" method="post"
											data-parsley-validate>
											@csrf
											<div class="row form-group">
												<div class="col-md-4">
													<label for="certificate_degree_name">Degree Name <span
															class="required">*</span></label>
													<input type="text" class="form-control"
														name="certificate_degree_name" id="certificate_degree_name"
														placeholder="Enter Degree Name" required>
												</div>
												<div class="col-md-4">
													<label for="major_subject">Major Subject <span
															class="required">*</span></label>
													<input type="text" class="form-control" name="major_subject"
														id="major_subject" placeholder="Enter Major Subject" required>
												</div>
												<div class="col-md-4">
													<label for="institute_university_name">Institution <span
															class="required">*</span></label>
													<input type="text" class="form-control"
														name="institute_university_name" id="institute_university_name"
														placeholder="Enter Institution/University" required>
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-4">
													<label for="start_date">Qualification Start Date <span
															class="required">*</span></label>
													<input type="date" class="form-control" name="start_date"
														id="start_date" placeholder="Enter Qualification Start Date"
														required>
												</div>
												<div class="col-md-4">
													<label for="end_date">Qualification End

													</label>
													<input type="date" class="form-control" name="end_date"
														id="end_date" placeholder="Enter Qualification End Date">
												</div>
												<div class="col-md-4">
													<label class="font12 text-muted" for="is_current_qualification">
														Current Qualification
													</label>
													<br>
													<input type="checkbox" name="is_current_qualification"
														id="is_current_qualification" value="1" class="" />
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-4">
													<label for="percentage">Result (Percentage)</label>
													<input type="number" class="form-control" name="percentage"
														id="percentage" placeholder="Result Percentage">
												</div>
												<div class="col-md-4">
													<label for="get_cgpa">Result in CGPA</label>
													<input type="text" class="form-control" name="get_cgpa"
														id="get_cgpa" placeholder="Enter CGPA">
												</div>
												<div class="col-md-4">
													<label for="on_cgpa">Out Of CGPA</label>
													<input type="text" class="form-control" name="on_cgpa" id="on_cgpa"
														placeholder="CGPA Out Of">
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-12">
													<label for="description">Details <span
															class="required">*</span></label>
													<textarea name="description" id="description" class="form-control"
														rows="3" required></textarea>
												</div>
											</div>

											<p class="text-left">
												<button type="submit" class="btn btn-outline-success"><i
														class="fa fa-check"></i> Save</button>
											</p>
										</form>
									</div>
								</div>
							</div>
						</div>
						@endif

						<div class="mt-4">
							@php
							$user_qualifications = $user->qualifications()->orderBy('is_current_qualification',
							'desc')->orderBy('end_date', 'desc')->get();
							@endphp

							@foreach ($user_qualifications as $qualification)
							<div class="single-work-experience">
								<i class="fa fa-circle-o experience-circle font24 text-yellow float-left"></i>
								<span class="hr-span"></span>
								<div class="work-history float-left ml-2">
									<span>
										<span
											class="text-yellow bold font16">{{ $qualification->institute_university_name }}
											/</span> <span class="text-muted"> {{ $qualification->start_date }} -
											<span class="text-muted">
												{{ $qualification->is_current_qualification ? 'Present' : $qualification->end_date }}
											</span>
										</span>
									</span>
									<p class="font-weight-bold text-theme font18">{{ $qualification->major_subject }} -
										{{ $qualification->certificate_degree_name }}</p>

									<p class="mt-1">
										{{ $qualification->description }}
									</p>
								</div>
								@if (Auth::check() && Auth::id() == $user->id)
								@if (Auth::id() == $qualification->user_id)
								<div class="float-right">
									<div class="dropdown">
										<i class="btn btn-edit mtminus40px fa fa-ellipsis-h" id="expMenu"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
										<div class="dropdown-menu" aria-labelledby="expMenu">
											<a class="dropdown-item"
												href="#editQualificationModal{{ $qualification->id }}"
												data-toggle="modal">
												<i class="fa fa-edit"></i> Edit
											</a>
											<a class="dropdown-item"
												href="#deleteQualificationModal{{ $qualification->id }}"
												data-toggle="modal">
												<i class="fa fa-trash"></i> Delete
											</a>
										</div>
									</div>

									<!-- Edit Qualification Modal -->
									<div class="modal fade" id="editQualificationModal{{ $qualification->id }}"
										tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
										aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Edit Qualification
													</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form
														action="{{ route('candidates.education.update', $qualification->id) }}"
														method="post" data-parsley-validate>
														@csrf
														<div class="row form-group">
															<div class="col-md-4">
																<label for="certificate_degree_name">Degree Name <span
																		class="required">*</span></label>
																<input type="text" class="form-control"
																	name="certificate_degree_name"
																	id="certificate_degree_name"
																	placeholder="Enter Degree Name"
																	value="{{ $qualification->certificate_degree_name }}"
																	required>
															</div>
															<div class="col-md-4">
																<label for="major_subject">Major Subject <span
																		class="required">*</span></label>
																<input type="text" class="form-control"
																	name="major_subject" id="major_subject"
																	placeholder="Enter Major Subject"
																	value="{{ $qualification->major_subject }}"
																	required>
															</div>
															<div class="col-md-4">
																<label for="institute_university_name">Institution <span
																		class="required">*</span></label>
																<input type="text" class="form-control"
																	name="institute_university_name"
																	id="institute_university_name"
																	placeholder="Enter Institution/University"
																	value="{{ $qualification->institute_university_name }}"
																	required>
															</div>
														</div>

														<div class="row form-group">
															<div class="col-md-4">
																<label for="start_date">Qualification Start Date <span
																		class="required">*</span></label>
																<input type="date" class="form-control"
																	name="start_date" id="start_date"
																	placeholder="Enter Qualification Start Date"
																	value="{{ $qualification->start_date }}" required>
															</div>
															<div class="col-md-4">
																<label for="end_date">Qualification End

																</label>
																<input type="date" class="form-control" name="end_date"
																	id="end_date"
																	placeholder="Enter Qualification End Date"
																	value="{{ $qualification->end_date }}">
															</div>
															<div class="col-md-4">
																<label class="font12 text-muted"
																	for="is_current_qualification">
																	Current Qualification
																</label>
																<br>
																<input type="checkbox" name="is_current_qualification"
																	id="is_current_qualification" value="1" class=""
																	{{ $qualification->is_current_qualification ? 'checked' : '' }} />
															</div>
														</div>

														<div class="row form-group">
															<div class="col-md-4">
																<label for="percentage">Result (Percentage)</label>
																<input type="number" class="form-control"
																	name="percentage" id="percentage"
																	placeholder="Result Percentage"
																	value="{{ $qualification->percentage }}">
															</div>
															<div class="col-md-4">
																<label for="get_cgpa">Result in CGPA</label>
																<input type="text" class="form-control" name="get_cgpa"
																	id="get_cgpa" placeholder="Enter CGPA"
																	value="{{ $qualification->get_cgpa }}">
															</div>
															<div class="col-md-4">
																<label for="on_cgpa">Out Of CGPA</label>
																<input type="text" class="form-control" name="on_cgpa"
																	id="on_cgpa" placeholder="CGPA Out Of"
																	value="{{ $qualification->on_cgpa }}">
															</div>
														</div>

														<div class="row form-group">
															<div class="col-md-12">
																<label for="description">Details <span
																		class="required">*</span></label>
																<textarea name="description" id="description"
																	class="form-control" rows="3"
																	required>{{ $qualification->description }}</textarea>
															</div>
														</div>

														<p class="text-left">
															<button type="submit" class="btn btn-outline-success"><i
																	class="fa fa-check"></i> Save</button>
														</p>
													</form>
												</div>
											</div>
										</div>
									</div>

									<!-- Delete Qualification Modal -->
									<div class="modal fade" id="deleteQualificationModal{{ $qualification->id }}"
										tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
										aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Delete Qualification
													</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form
														action="{{ route('candidates.education.delete', $qualification->id) }}"
														method="post" data-parsley-validate>
														@csrf
														<p>
															Are you sure to delete the qualification -
															"<mark>{{ $qualification->certificate_degree_name }}</mark>"
														</p>

														<p class="text-center">
															<button type="submit" class="btn btn-outline-success"><i
																	class="fa fa-check"></i> Confirm Delete</button>
														</p>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endif
								@endif
								<div class="clearfix"></div>
							</div> <!-- End Single Work Experience -->
							@endforeach


						</div>
					</div>

					<!-- Awards -->
					<div class="mt-5">
						<h5 class="text-theme text-uppercase float-left">
							<i class="fa fa-certificate"></i> Awards and Prizes
						</h5>
						@if (Auth::check() && Auth::id() == $user->id)
						<div class="float-right">
							<a href="#addAwardModal" class="btn btn-yellow" data-toggle="modal" title="Add New Award">
								<i class="fa fa-plus-circle" aria-hidden="true"></i>
							</a>
						</div>
						@endif
						<div class="clearfix"></div>

						@if (Auth::check() && Auth::id() == $user->id)
						<div class="modal fade" id="addAwardModal" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add New Award and Price</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('candidates.award.store') }}" method="post"
											data-parsley-validate>
											@csrf
											<div class="row form-group">
												<div class="col-md-12">
													<label for="award_name">Award Name <span
															class="required">*</span></label>
													<input type="text" class="form-control" name="award_name"
														id="award_name" placeholder="Enter Award Title" required>
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-6">
													<label for="date">Award Date <span class="required">*</span></label>
													<input type="date" class="form-control" name="date" id="date"
														placeholder="Enter Award Date" required>
												</div>
												<div class="col-md-6">
													<label for="company_name">Award Company/Institution <span
															class="required">*</span></label>
													<input type="text" class="form-control" name="company_name"
														id="company_name"
														placeholder="Enter Award Company/Institution Name" required>
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-12">
													<label for="description">Details <span
															class="required">*</span></label>
													<textarea name="description" id="description" class="form-control"
														rows="3" required></textarea>
												</div>
											</div>

											<p class="text-left">
												<button type="submit" class="btn btn-outline-success"><i
														class="fa fa-check"></i> Save</button>
											</p>
										</form>
									</div>
								</div>
							</div>
						</div>
						@endif

						<div class="mt-4">
							@php
							$user_awards = $user->awards()->orderBy('date', 'desc')->get();
							@endphp
							@foreach ($user_awards as $award)
							<div class="single-work-experience">
								<i class="fa fa-circle-o experience-circle font24 text-yellow float-left"></i>
								<span class="hr-span"></span>
								<div class="work-history float-left ml-3">
									<span>
										<span class="text-yellow bold font16"> {{ $award->company_name }}/</span> <span
											class="text-muted"> {{ $award->date }}</span>
									</span>
									<p class="font-weight-bold text-theme font18">{{ $award->award_name }}</p>

									<p class="mt-1">
										{{ $award->description }}
									</p>
								</div>
								@if (Auth::check() && Auth::id() == $user->id)
								@if (Auth::id() == $award->user_id)
								<div class="float-right">
									<div class="dropdown">
										<i class="btn btn-edit mtminus40px fa fa-ellipsis-h" id="expMenu"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
										<div class="dropdown-menu" aria-labelledby="expMenu">
											<a class="dropdown-item" href="#editAwardModal{{ $award->id }}"
												data-toggle="modal">
												<i class="fa fa-edit"></i> Edit
											</a>
											<a class="dropdown-item" href="#deleteAwardModal{{ $award->id }}"
												data-toggle="modal">
												<i class="fa fa-trash"></i> Delete
											</a>
										</div>
									</div>
								</div>

								<!-- Edit Award Model -->
								<div class="modal fade" id="editAwardModal{{ $award->id }}" tabindex="-1" role="dialog"
									aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Edit Award and Price</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="{{ route('candidates.award.update', $award->id) }}"
													method="post" data-parsley-validate>
													@csrf
													<div class="row form-group">
														<div class="col-md-12">
															<label for="award_name">Award Name <span
																	class="required">*</span></label>
															<input type="text" class="form-control" name="award_name"
																id="award_name" placeholder="Enter Award Title"
																value="{{ $award->award_name }}" required>
														</div>
													</div>

													<div class="row form-group">
														<div class="col-md-6">
															<label for="date">Award Date <span
																	class="required">*</span></label>
															<input type="date" class="form-control" name="date"
																id="date" placeholder="Enter Award Date"
																value="{{ $award->date }}" required>
														</div>
														<div class="col-md-6">
															<label for="company_name">Award Company/Institution <span
																	class="required">*</span></label>
															<input type="text" class="form-control" name="company_name"
																id="company_name"
																placeholder="Enter Award Company/Institution Name"
																value="{{ $award->company_name }}" required>
														</div>
													</div>

													<div class="row form-group">
														<div class="col-md-12">
															<label for="description">Details <span
																	class="required">*</span></label>
															<textarea name="description" id="description"
																class="form-control" rows="3"
																required>{{ $award->description }}</textarea>
														</div>
													</div>

													<p class="text-left">
														<button type="submit" class="btn btn-outline-success"><i
																class="fa fa-check"></i> Update</button>
													</p>
												</form>
											</div>
										</div>
									</div>
								</div>


								<!-- Delete Award Modal -->
								<div class="modal fade" id="deleteAwardModal{{ $award->id }}" tabindex="-1"
									role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Delete Award</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="{{ route('candidates.award.delete', $award->id) }}"
													method="post" data-parsley-validate>
													@csrf
													<p>
														Are you sure to delete the award -
														"<mark>{{ $award->award_name }}</mark>"
													</p>

													<p class="text-center">
														<button type="submit" class="btn btn-outline-success"><i
																class="fa fa-check"></i> Confirm Delete</button>
													</p>
												</form>
											</div>
										</div>
									</div>
								</div>

								@endif
								@endif
								<div class="clearfix"></div>
							</div> <!-- End Single Award -->
							@endforeach


						</div>
					</div>


					<!-- Skills -->
					<div class="mt-5">
						<h5 class="text-theme text-uppercase float-left">
							<i class="fa fa-bars"></i> Skills
						</h5>
						@if (Auth::check() && Auth::id() == $user->id)
						<div class="float-right">
							<a href="#addSkillModal" class="btn btn-yellow" data-toggle="modal" title="Add New Skill">
								<i class="fa fa-plus-circle" aria-hidden="true"></i>
							</a>
						</div>
						@endif
						<div class="clearfix"></div>

						<!-- Add Skill Modal -->

						@if (Auth::check() && Auth::id() == $user->id)
						<div class="modal fade" id="addSkillModal" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add New Skill</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('candidates.skill.store') }}" method="post"
											data-parsley-validate>
											@csrf
											<div class="row form-group">
												<div class="col-md-12">
													<label for="skill_id">Select Skill <span
															class="required">*</span></label>
													<select name="skill_id" id="skill_id" class="form-control">
														<option value="">Choose a skill to add</option>
														@foreach (App\Models\Skill::orderBy('name', 'asc')->get() as
														$skill)
														<option value="{{ $skill->id }}">{{ $skill->name }}</option>
														@endforeach
													</select>
												</div>
												<div class="col-md-12">
													<label for="percentage">Skill Covered <span
															class="required">*</span></label>
													<input type="number" class="form-control" name="percentage"
														id="percentage" placeholder="Enter % you coverd">
												</div>
											</div>


											<p class="text-left">
												<button type="submit" class="btn btn-outline-success"><i
														class="fa fa-check"></i> Save</button>
											</p>
										</form>
									</div>
								</div>
							</div>
						</div>
						@endif

						<div class="mt-4">
							<div class="row">
								@foreach ($user->skills as $sk)
								<div class="col-md-6">
									<div class="skill-div">

										<h6 class="text-theme font16 font-weight-bold float-left">
											{{ $sk->skill->name }}
										</h6>
										<div class="ml-0 float-left progress">
											<div class="progress-bar progress-bar-striped" role="progressbar"
												style="width: {{ $sk->percentage }}%"
												aria-valuenow="{{ $sk->percentage }}" aria-valuemin="0"
												aria-valuemax="100"></div>
										</div>

										@if (Auth::check() && Auth::id() == $user->id)
										@if (Auth::id() == $sk->user_id)
										<div class="float-right mtminus65px">
											<div class="dropdown">
												<i class="btn btn-edit fa fa-ellipsis-h" id="expMenu"
													data-toggle="dropdown" aria-haspopup="true"
													aria-expanded="false"></i>
												<div class="dropdown-menu" aria-labelledby="expMenu">
													<a class="dropdown-item" href="#editSkillMoal{{ $sk->id }}"
														data-toggle="modal">
														<i class="fa fa-edit"></i> Edit
													</a>
													<a class="dropdown-item" href="#deleteSkillModal{{ $sk->id }}"
														data-toggle="modal">
														<i class="fa fa-trash"></i> Delete
													</a>
												</div>
											</div>
										</div>
										@endif
										@endif
										<div class="clearfix"></div>
									</div>
								</div>

								<!-- Edit Skill -->
								<div class="modal fade" id="editSkillMoal{{ $sk->id }}" tabindex="-1" role="dialog"
									aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Edit Skill</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="{{ route('candidates.skill.update', $sk->id) }}"
													method="post" data-parsley-validate>
													@csrf
													<div class="row form-group">
														<div class="col-md-12">
															<label for="skill_id">Select Skill <span
																	class="required">*</span></label>
															<select name="skill_id" id="skill_id" class="form-control">
																<option value="">Choose a skill to add</option>
																@foreach (App\Models\Skill::orderBy('name',
																'asc')->get() as $skill)
																<option value="{{ $skill->id }}"
																	{{ $sk->skill_id == $skill->id ? 'selected' : '' }}>
																	{{ $skill->name }}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-12">
															<label for="percentage">Skill Covered <span
																	class="required">*</span></label>
															<input type="number" class="form-control" name="percentage"
																id="percentage" placeholder="Enter % you coverd"
																value="{{ $sk->percentage }}">
														</div>
													</div>


													<p class="text-left">
														<button type="submit" class="btn btn-outline-success"><i
																class="fa fa-check"></i> Update</button>
													</p>
												</form>
											</div>
										</div>
									</div>
								</div>

								<!-- Delete Skill Modal -->
								<div class="modal fade" id="deleteSkillModal{{ $sk->id }}" tabindex="-1" role="dialog"
									aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Delete Skill</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="{{ route('candidates.skill.delete', $sk->id) }}"
													method="post" data-parsley-validate>
													@csrf
													<p>
														Are you sure to delete the skill -
														"<mark>{{ $sk->skill->name }}</mark>"
													</p>

													<p class="text-center">
														<button type="submit" class="btn btn-outline-success"><i
																class="fa fa-check"></i> Confirm Delete</button>
													</p>
												</form>
											</div>
										</div>
									</div>
								</div>

								@endforeach
							</div>
						</div>
					</div>

					<!-- Portfolio -->
					<div class="mt-5">
						<h5 class="text-theme text-uppercase float-left">
							<i class="fa fa-pencil-square-o"></i> Portfolio
						</h5>
						@if (Auth::check() && Auth::id() == $user->id)
						<div class="float-right">
							<a href="#addPortfolioModal" class="btn btn-yellow" data-toggle="modal"
								title="Add New Portfolio">
								<i class="fa fa-plus-circle" aria-hidden="true"></i>
							</a>
						</div>
						@endif
						<div class="clearfix"></div>

						<!-- Add Portfolio Modal -->
						@if (Auth::check() && Auth::id() == $user->id)
						<div class="modal fade" id="addPortfolioModal" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add New Portfolio</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('candidates.portfolio.store') }}" method="post"
											enctype="multipart/form-data" data-parsley-validate>
											@csrf
											<div class="row form-group">
												<div class="col-md-6">
													<label for="title">Title<span class="required">*</span></label>
													<input type="text" class="form-control" name="title" id="title"
														placeholder="Enter Portfolio Title" required>
												</div>
												<div class="col-md-6">
													<label for="link">Online Link<span class="text-info font12">
															optional</span></label>
													<input type="url" class="form-control" name="link" id="link"
														placeholder="Enter Portfolio link">
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-6">
													<label for="image">Featured Image<span
															class="required">*</span></label>
													<input type="file" class="form-control" name="image" id="image"
														placeholder="Enter Featured Image" required>
												</div>
												<div class="col-md-6">
													<label for="file">Project File<span class="text-info font12">
															optional - only zip</span></label>
													<input type="file" class="form-control" name="file" id="file"
														placeholder="Enter Portfolio file">
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-12">
													<label for="description">Details <span
															class="required">*</span></label>
													<textarea name="description" id="description" class="form-control"
														rows="3" required placeholder="Write a description"></textarea>
												</div>
											</div>

											<p class="text-left">
												<button type="submit" class="btn btn-outline-success"><i
														class="fa fa-check"></i> Save</button>
											</p>
										</form>
									</div>
								</div>
							</div>
						</div>
						@endif
						@php
						$user_portfolios = $user->portfolios()->orderBy('priority', 'asc')->get();
						@endphp
						<div class="mt-4">
							<div class="row">
								@foreach ($user_portfolios as $portfolio)
								<div class="col-md-3">
									<a href="#portfolioModal{{ $portfolio->id }}" class="portfolio-link"
										title="{{ $portfolio->title }}">
										<img src="{{ asset('images/portfolios/'.$portfolio->image) }}" alt=""
											class="img img-fluid img-thumbnail">
									</a>
									<i class="fa fa-eye portfolio-hover-icon animated fadeIn"
										title="{{ $portfolio->title }}" data-toggle="modal"
										data-target="#portfolioModal{{ $portfolio->id }}"></i>
								</div>

								<!-- View Portfolio Modal -->
								<div class="modal animated fadeIn" id="portfolioModal{{ $portfolio->id }}">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">

											<!-- Modal Header -->
											<div class="modal-header">
												<h4 class="modal-title text-theme font22 bold">{{$portfolio->title}}

													@if (Auth::check() && Auth::id() == $user->id)
													@if (Auth::id() == $portfolio->user_id)
													<span class="ml-3">
														<a class="btn btn-outline-info btn-sm"
															href="#editPortfolioMoal{{ $portfolio->id }}"
															data-toggle="modal" title="Edit Portfolio">
															<span class="fa fa-edit"></span>
														</a>

														<a class="btn btn-outline-danger btn-sm"
															href="#deletePortfolioModal{{ $portfolio->id }}"
															data-toggle="modal" title="Delete Portfolio"
															onclick="$('#portfolioModal{{ $portfolio->id }}').modal('toggle')">
															<span class="fa fa-trash"></span>
														</a>
													</span>
													@endif
													@endif

												</h4>
												<button type="button" class="close ml-2"
													data-dismiss="modal">&times;</button>
											</div>

											@if (Auth::check() && Auth::id() == $user->id)
											@if (Auth::id() == $portfolio->user_id)
											<div class="modal fade" id="editPortfolioMoal{{ $portfolio->id }}"
												tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
												aria-hidden="true">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">Edit
																Portfolio</h5>
															<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form
																action="{{ route('candidates.portfolio.update', $portfolio->id) }}"
																method="post" enctype="multipart/form-data"
																data-parsley-validate>
																@csrf
																<div class="row form-group">
																	<div class="col-md-6">
																		<label for="title">Title<span
																				class="required">*</span></label>
																		<input type="text" class="form-control"
																			name="title" id="title"
																			placeholder="Enter Portfolio Title"
																			value="{{ $portfolio->title }}" required>
																	</div>
																	<div class="col-md-6">
																		<label for="link">Online Link<span
																				class="text-info font12">
																				optional</span></label>
																		<input type="url" class="form-control"
																			name="link" id="link"
																			placeholder="Enter Portfolio link"
																			value="{{ $portfolio->link }}">
																	</div>
																</div>

																<div class="row form-group">
																	<div class="col-md-6">
																		<label for="image">Featured Image
																			<span class="text-info font12"> optional
																				@if (!is_null($portfolio->image))
																				<a href="{{ asset('images/portfolios/'.$portfolio->image)  }}"
																					target="_blank"><i
																						class="fa fa-download"></i>
																					Previous</a>
																				@endif
																			</span>
																		</label>
																		<input type="file" class="form-control"
																			name="image" id="image"
																			placeholder="Enter Featured Image">
																	</div>
																	<div class="col-md-6">
																		<label for="file">Portfolio File<span
																				class="text-info font12"> optional -
																				only zip
																				@if (!is_null($portfolio->file))
																				<a href="{{ asset('files/portfolios/'.$portfolio->file)  }}"
																					target="_blank"><i
																						class="fa fa-download"></i>
																					Previous</a>
																				@endif
																			</span></label>
																		<input type="file" class="form-control"
																			name="file" id="file"
																			placeholder="Enter Portfolio file">
																	</div>
																</div>

																<div class="row form-group">
																	<div class="col-md-12">
																		<label for="description">Details <span
																				class="required">*</span></label>
																		<textarea name="description" id="description"
																			class="form-control" rows="3" required
																			placeholder="Write a description">{{ $portfolio->description }}</textarea>
																	</div>
																</div>

																<p class="text-left">
																	<button type="submit"
																		class="btn btn-outline-success"><i
																			class="fa fa-check"></i> Update</button>
																</p>
															</form>
														</div>
													</div>
												</div>
											</div>
											@endif
											@endif

											<!-- Modal body -->
											<div class="modal-body">
												<div class="row justify-content-center">
													<div class="col-sm-8">
														<img src="{{ asset('images/portfolios/'.$portfolio->image) }}"
															alt="" class="img img-fluid">
													</div>
												</div>
												<div>
													<hr>
													{{ $portfolio->description }}
													<p>
														<a target="_blank" href="{{ $portfolio->link }}"
															class="theme-link"><i class="fa fa-link"></i>
															{{ $portfolio->link }}</a>
													</p>
												</div>
											</div>

										</div>
									</div>
								</div>

								<div class="modal fade" id="deletePortfolioModal{{ $portfolio->id }}" tabindex="-1"
									role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Delete Portfolio</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form
													action="{{ route('candidates.portfolio.delete', $portfolio->id) }}"
													method="post" data-parsley-validate>
													@csrf
													<p>
														Are you sure to delete the portfolio -
														"<mark>{{ $portfolio->title }}</mark>"
													</p>

													<p class="text-center">
														<button type="submit" class="btn btn-outline-success"><i
																class="fa fa-check"></i> Confirm Delete</button>
													</p>
												</form>
											</div>
										</div>
									</div>
								</div>


								<!-- Edit and Delete Portfolio -->

								@endforeach


							</div>
						</div>
					</div>
					<!-- Portfolio -->


				</div>
			</div>
			<div class="col-md-4">

				<div class="widget widget-profile mb-3">
					<img src="{{ App\Helpers\ReturnPathHelper::getUserImage($user->id) }}" class="img img-fluid">
					<div class="float-right">
						@if (Auth::check() && Auth::id() == $user->id)
						<div class="float-right">
							<a href="#editProfileModal" class="btn btn-outline-secondary" data-toggle="modal"><i
									class="fa fa-edit"></i></a>
						</div>

						<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">About Yourself</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" style="text-align: left!important">
										<form action="{{ route('candidates.profile.update', $user->id) }}" method="post"
											data-parsley-validate enctype="multipart/form-data">
											@csrf
											<div class="row form-group">
												<div class="col-md-6">
													<label for="name">Your Name <span class="required">*</span></label>
													<input type="text" name="name" id="name" class="form-control"
														required value="{{ $user->name }}" />
												</div>
												<div class="col-md-6">
													<label for="profile_picture">Your Profile Picture <span
															class="text-info font12"> optional</span></label>
													<input type="file" name="profile_picture" id="profile_picture"
														class="form-control" />
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-4">
													<label for="gender">Gender <span class="required">*</span></label>
													<select name="gender" id="gender" class="form-control" required>
														<option value="Male"
															{{ $user->candidate->gender == "Male" ? 'selected' : '' }}>
															Male</option>
														<option value="Female"
															{{ $user->candidate->gender == "Female" ? 'selected' : '' }}>
															Female</option>
														<option value="Other"
															{{ $user->candidate->gender == "Other" ? 'selected' : '' }}>
															Other</option>
													</select>
												</div>
												<div class="col-md-4">
													<label for="career_level_id">Career Level <span
															class="required">*</span></label>
													<select name="career_level_id" id="career_level_id"
														class="form-control" required>
														@foreach (App\Models\CareerLevel::all() as $cLevel)
														<option value="{{ $cLevel->id }}"
															{{ $user->candidate->career_level_id == $cLevel->id ? 'selected' : '' }}>
															{{ $cLevel->name }}</option>
														@endforeach
													</select>
												</div>
												<div class="col-md-4">
													<label for="date_of_birth">Date of Birth <span
															class="required">*</span></label>
													<input type="date" name="date_of_birth" id="date_of_birth"
														class="form-control"
														value="{{ $user->candidate->date_of_birth }}" required />
												</div>

											</div>

											<div class="row form-group">
												<div class="col-md-6">
													<label for="cv">Curriculam Vitae (CV) <span
															class="text-info font12">optional</span></label>
													<input type="file" name="cv" id="cv" class="form-control" />
												</div>
												<div class="col-md-6">
													<label for="sector">Primary Sector <span
															class="required">*</span></label>
													<select name="sector" id="sector" class="form-control" required>
														@foreach (App\Models\Category::orderBy('name', 'asc')->get() as
														$category)
														<option value="{{ $category->id }}"
															{{ $user->candidate->sector == $category->id ? 'selected' : '' }}>
															{{ $category->name }}</option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="row form-group border-top pt-3 mt-3">
												<div class="col-md-12">
													<h5 class="text-center">Social Links</h5>
												</div>
												<div class="col-md-6">
													<label for="sector">Facebook <span class="text-info font12">
															optional</span></label>
													<input type="url" name="facebook_link" id="facebook_link"
														class="form-control" value="{{ $user->facebook_link }}" />
												</div>
												<div class="col-md-6">
													<label for="linkedin_link">LinkedIn <span class="text-info font12">
															optional</span></label>
													<input type="url" name="linkedin_link" id="linkedin_link"
														class="form-control" value="{{ $user->linkedin_link }}" />
												</div>

												<div class="col-md-6">
													<label for="twitter_link">Twitter <span class="text-info font12">
															optional</span></label>
													<input type="url" name="twitter_link" id="twitter_link"
														class="form-control" value="{{ $user->twitter_link }}" />
												</div>

												<div class="col-md-6">
													<label for="google_plus_link">Google Plus <span
															class="text-info font12"> optional</span></label>
													<input type="url" name="google_plus_link" id="google_plus_link"
														class="form-control" value="{{ $user->google_plus_link }}" />
												</div>
											</div>

											<p class="text-left">
												<button type="submit" class="btn btn-outline-success"><i
														class="fa fa-check"></i> Save</button>
											</p>
										</form>
									</div>
								</div>
							</div>
						</div>

						@endif
					</div>
					<div class="clearfix"></div>

					<h5 class="text-theme">{{ $user->name }}</h5>
					<p class="text-theme">
						@if (!is_null($user->currentJob()))
						<span class="text-yellow">{{ $user->currentJob()->job_title }}</span> at
						{{ $user->currentJob()->company_name }}
						@endif

					</p>
					<p class="text-theme"><a href="" class="text-theme">{{ $user->email }}</a></p>
					<p class=""><i class="fa fa-map-marker text-theme"></i> <span
							class="text-theme">{{ $user->location->country->name }}</span></p>
					<p class="text-muted">Member since {{ substr($user->created_at, 0,4) }}</p>
					<p class="mt-2 mb-2 user-cv">
						@if (!empty($user->candidate))
							@if (!empty($user->candidate->cv))
								<a href="{{ asset('files/cv/'.$user->candidate->cv) }}" title="Download CV"
								target="_blank"><i class="fa fa-file-pdf-o"></i></a>
							@endif
						@endif
					</p>
					<p>
						<a href="{{ route('candidates.showResume', $user->username) }}" target="_blank"
							class="btn btn-warning">
							<i class="fa fa-file-pdf-o"></i> CV (generated)
						</a>
					</p>
					<div class="mt-2">
						<div class="footer-social">
							<a href="{{ $user->facebook_link }}" target="_blank"><i
									class="fa fa-facebook facebook-icon"></i></a>
							<a href="{{ $user->twitter_link }}" target="_blank"><i
									class="fa fa-twitter twitter-icon"></i></a>
							<a href="{{ $user->googple_plus_link }}" target="_blank"><i
									class="fa fa-google-plus google-plus-icon"></i></a>
							<a href="{{ $user->linkedin_link }}" target="_blank"><i
									class="fa fa-linkedin linkedin-icon"></i></a>
						</div>
					</div>
				</div>


				<div class="widget widget-working-preference mb-3">
					<h5 class="widget-title mb-3">Working Preference</h5>
					<div class="working-preference-item mt-3 ml-4">
						<i class="fa fa-user-o font30 float-left mt-2"></i>
						<div class="float-left ml-3">
							<p class="text-theme font-weight-bold font16">
								Age
							</p>
							<p class="text-muted">{{ $user->age() }}</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="working-preference-item mt-3 ml-4">
						<i class="fa fa-venus-mars font30 float-left mt-2"></i>
						<div class="float-left ml-3">
							<p class="text-theme font-weight-bold font16">
								Gender
							</p>
							<p class="text-muted">{{ $user->candidate->gender }}</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="working-preference-item mt-3 ml-4">
						<i class="fa fa-paw font30 float-left mt-2"></i>
						<div class="float-left ml-3">
							<p class="text-theme font-weight-bold font16">
								Career Level
							</p>
							<p class="text-muted">{{ $user->candidate->career_level->name }}</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="working-preference-item mt-3 ml-4">
						<i class="fa fa-bars font30 float-left mt-2"></i>
						<div class="float-left ml-3">
							<p class="text-theme font-weight-bold font16">
								Category
							</p>
							<p class="text-muted">{{ $user->candidate->sector_data->name }}</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="working-preference-item mt-3 ml-4">
						<i class="fa fa-group font30 float-left mt-2"></i>
						<div class="float-left ml-3">
							<p class="text-theme font-weight-bold font16">
								Experience
							</p>
							<p class="text-muted">{{ $user->getExperienceInYears() }}
								Year{{ $user->getExperienceInYears() > 1 ? 's' : '' }}</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="working-preference-item mt-3 ml-4">
						<i class="fa fa-graduation-cap font30 float-left mt-2"></i>
						<div class="float-left ml-3">
							<p class="text-theme font-weight-bold font16">
								Qualification
							</p>
							<p class="text-muted">
								@if (!is_null($user->lastQualification()))
								{{ $user->lastQualification()->certificate_degree_name }}
								@else
								--
								@endif

							</p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>

				@if ((Auth::check() && Auth::id() != $user->id) || !Auth::check())
				<div class="employer-detail-sidebar">
					<div class="widget-contact mt-3">
						<h5 class="text-theme">
							Contact with the Employer
						</h5>
						@include('frontend.pages.partials.send-message')
					</div>
				</div>
				@endif 
				</div>
			</div>
		</div>
	</div>
</section>
@endsection


@section('scripts')

@endsection