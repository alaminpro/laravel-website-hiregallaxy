@extends('frontend.layouts.master')

@section('title')
Employer - {{ $user->name }} | {{ App\Models\Setting::first()->site_title }}
@endsection

@section('stylesheets')

@endsection

@section('content')
<section class="employer-page sec-pad">
	<div class="container">
		<div class="header-company-profile">
			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="row">
						<div class="col-sm-3 text-center mb-4">
							<img src="{{ App\Helpers\ReturnPathHelper::getUserImage($user->id) }}"
								class="img img-fluid">
						</div>
						<div class="col-sm-9">
							<div class="pl-5">
								<div class="single-job-description">
									<h3>{{ $user->name }}</h3>
									<div class="float-right">
										@if (Auth::check() && Auth::id() == $user->id)
										<div class="float-right">
											<a href="#editProfileModal" class="btn btn-outline-secondary"
												data-toggle="modal"><i class="fa fa-edit"></i></a>
										</div>
										<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog"
											aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">About Yourself
														</h5>
														<button type="button" class="close" data-dismiss="modal"
															aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body" style="text-align: left!important">
														<form
															action="{{ route('employers.profile.update', $user->id) }}"
															method="post" data-parsley-validate
															enctype="multipart/form-data">
															@csrf
															<div class="row form-group">
																<div class="col-md-6">
																	<label for="name">Company Name <span
																			class="required">*</span></label>
																	<input type="text" name="name" id="name"
																		class="form-control" required
																		value="{{ $user->name }}" />
																</div>
																<div class="col-md-6">
																	<label for="profile_picture">Company Profile Picture
																		<span class="text-info font12">
																			optional</span></label>
																	<input type="file" name="profile_picture"
																		id="profile_picture" class="form-control" />
																</div>
															</div>


															<div class="row form-group">
																<div class="col-md-6">
																	<label for="category_id">Position <span
																			class="required">*</span></label>
																	<select name="category_id" id="category_id"
																		class="form-control" required>
																		@foreach (App\Models\Category::orderBy('name',
																		'asc')->get() as $category)
																		<option value="{{ $category->id }}"
																			{{ $user->company->category_id == $category->id ? 'selected' : '' }}>
																			{{ $category->name }}</option>
																		@endforeach
																	</select>
																</div>
																<div class="col-md-6">
																	<label for="website">Website <span
																			class="text-info font12">
																			optional</span></label>
																	<input type="url" name="website" id="website"
																		class="form-control"
																		value="{{ $user->website }}" />
																</div>


																<div class="col-md-12 mt-3">
																	<label for="sectors"> Sectors <span
																			class="required">*</span></label>
																	<br>
																	<select name="sectors[]" id="sectors"
																		class="select2 form-control" required multiple>
																		@foreach (App\Models\Sector::orderBy('name',
																		'asc')->get() as $sector)
																		<option value="{{ $sector->id }}"
																			{{ $user->hasSectorOrNot($sector->id) ? 'selected' : '' }}>
																			{{ $sector->name }}</option>
																		@endforeach
																	</select>
																</div>


															</div>

															<div class="row form-group">
																<div class="col-md-4">
																	<label for="phone_no">Phone No <span
																			class="text-info font12">
																			optional</span></label>
																	<input type="text" name="phone_no" id="phone_no"
																		class="form-control"
																		value="{{ $user->phone_no }}" />
																</div>

																<div class="col-md-4">
																	<label for="establish_date">Established Date <span
																			class="text-info font12">
																			optional</span></label>
																	<input type="date" name="establish_date"
																		id="establish_date" class="form-control"
																		value="{{ $user->company->establish_date }}" />
																</div>

																<div class="col-md-4">
																	<label for="team_member">Team Size <span
																			class="text-info font12">
																			optional</span></label>
																	<select name="team_member" id="team_member"
																		class="form-control">
																		@foreach (App\Models\TeamSize::get() as $team)
																		<option value="{{ $team->id }}"
																			{{ $user->company->team_member == $team->id ? 'selected' : '' }}>
																			{{ $team->name }}</option>
																		@endforeach
																	</select>
																</div>
															</div>

															<div class="row form-group border-top pt-3 mt-3">
																<div class="col-md-12">
																	<h5 class="text-center">Social Links</h5>
																</div>
																<div class="col-md-6">
																	<label for="sector">Facebook <span
																			class="text-info font12">
																			optional</span></label>
																	<input type="url" name="facebook_link"
																		id="facebook_link" class="form-control"
																		value="{{ $user->facebook_link }}" />
																</div>
																<div class="col-md-6">
																	<label for="linkedin_link">LinkedIn <span
																			class="text-info font12">
																			optional</span></label>
																	<input type="url" name="linkedin_link"
																		id="linkedin_link" class="form-control"
																		value="{{ $user->linkedin_link }}" />
																</div>

																<div class="col-md-6">
																	<label for="twitter_link">Twitter <span
																			class="text-info font12">
																			optional</span></label>
																	<input type="url" name="twitter_link"
																		id="twitter_link" class="form-control"
																		value="{{ $user->twitter_link }}" />
																</div>

																<div class="col-md-6">
																	<label for="google_plus_link">Google Plus <span
																			class="text-info font12">
																			optional</span></label>
																	<input type="url" name="google_plus_link"
																		id="google_plus_link" class="form-control"
																		value="{{ $user->google_plus_link }}" />
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
									<p class="text-yellow mb-3">
										<span class="text-dark">Position:</span>
										<a href="{{ route('jobs.categories.show', $user->company->category->slug) }}"
											target="_blank" class="badge badge-category pl-2 pr-2 mt-2">
											{{ $user->company->category->name }}
										</a>

										<br>
										<span class="text-dark">Sectors:</span>
										@if (count($user->sectors) > 0)
										@foreach ($user->sectors as $sector)
										<span class="badge badge-category pl-2 pr-2 mt-2">
											{{ $sector->sector->name }}
										</span>
										@endforeach
										@endif
									</p>
									<p>
										<span class="ml-2">
											<i class="fa fa-map-marker location-icon"></i>
											{{ $user->location->street_address }},
											{{ $user->location->country->name }}
										</span>
										<span class="ml-2">
											<a href="{{ $user->website }}" target="_blank" class="text-link"><i
													class="fa fa-globe"></i> {{ $user->website }}</a>
										</span>
									</p>
									<p>
										<span class="mr-2">
											<i class="fa fa-envelope"></i> {{ $user->email }}
										</span>
										@if (!is_null($user->phone_no))
										<span class="ml-2">
											<i class="fa fa-phone"></i> {{ $user->phone_no }}
										</span>
										@endif

									</p>
									<div class="mt-3">
										<div class="footer-social">
											<a href="{{ $user->facebook_link }}"><i
													class="fa fa-facebook facebook-icon"></i></a>
											<a href="{{ $user->twitter_link }}"><i
													class="fa fa-twitter twitter-icon"></i></a>
											<a href="{{ $user->googple_plus_link }}"><i
													class="fa fa-google-plus google-plus-icon"></i></a>
											<a href="{{ $user->linkedin_link }}"><i
													class="fa fa-linkedin linkedin-icon"></i></a>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="row mt-5">
			<div class="col-md-8">
				<div class="employer-detail-main">
					<h5 class="text-theme">
						Overview
					</h5>
					<div class="row mt-3">
						<div class="col-4">
							<div class="employer-top-item">
								<i class="fa fa-cog float-left"></i>
								<div class="float-left">
									<h6>Position</h6>
									<p>{{ $user->company->category->name }}</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-4">
							<div class="employer-top-item">
								<i class="fa fa-shopping-bag float-left"></i>
								<div class="float-left">
									<h6>Posted Jobs</h6>
									<p>{{ count($user->jobs) }}</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-4">
							<div class="employer-top-item">
								<i class="fa fa-eye float-left"></i>
								<div class="float-left">
									<h6>Viewed</h6>
									<p>{{ $user->company->total_view }}</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-4">
							<div class="employer-top-item">
								<i class="fa fa-clock-o float-left"></i>
								<div class="float-left">
									<h6>Since</h6>
									<p>{{ $user->company->establish_year }}</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-4">
							<div class="employer-top-item">
								<i class="fa fa-users float-left"></i>
								<div class="float-left">
									<h6>Team Size</h6>
									@if ($user->company->team_member != null)
									<p>{{ $user->company->team->name }}</p>
									@else
									<p class="text-danger">Not Set</p>
									@endif

								</div>
								<div class="clearfix"></div>
							</div>
						</div>

					</div>
					<div class="mt-5">
						<h5 class="text-theme mb-4 float-left">
							Company Description
						</h5>
						@if (Auth::check() && Auth::id() == $user->id)
						<div class="float-right">
							<a href="#editAboutModal" class="btn btn-outline-secondary" data-toggle="modal"><i
									class="fa fa-edit"></i></a>
						</div>

						<div class="modal fade" id="editAboutModal" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">About Yourself</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('employers.about.update', $user->id) }}" method="post"
											data-parsley-validate>
											@csrf
											<div class="row form-group">
												<div class="col-md-12">
													<label for="about">Company Description <span
															class="required">*</span></label>
													<textarea name="about" id="aboutCompanyDescription"
														class="form-control" rows="3">{!! $user->about !!}</textarea>
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

						<div class="description-area">
							{!! $user->about !!}
						</div>

					</div>

				</div>

				@if (count($user->jobs()->where('status_id', 1)->get()) > 0)
				<div class="mt-5">
					<div class="more-jobs">
						<h5 class="text-theme bold">Active Jobs from {{ $user->name }}</h5>
						@foreach ($jobs_employer = $user->jobs()->where('status_id', 1)->paginate(20) as $key => $single_job)
						@include('frontend.pages.partials.single-job-search')
						@endforeach
						<div class="mt-2">
							{{ $jobs_employer->links() }}
						</div>
					</div>
				</div>
				@endif

			</div>
			<div class="col-md-4">
				<div class="employer-detail-sidebar">
					@if (Auth::check())
					@if ($user->id != Auth::id())
					<h5 class="text-theme">
						Contact with the Employer
					</h5>
					@include('frontend.pages.partials.send-message')
					@endif
					@else
					<h5 class="text-theme">
						Contact with the Employer
					</h5>
					@include('frontend.pages.partials.send-message')

					@endif
				</div>
			</div>
		</div>
	</div>
</section>
@endsection


@section('scripts')
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
		min-width:320px;
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

	.select2-container--default .select2-selection--multiple {
		background-color: white;
		border: 1px solid #aaa;
		border-radius: 4px;
		cursor: text;
		/*min-width: 767px;*/
	}

	.badge-category {
		color: #FFF;
		background-color: #ff7c39;
		font-weight: normal;
		font-size: 15px;
	}

	.badge-category:hover {
		color: #FFF;
	}
</style>
<script>
	$(".select2").select2();
</script>
@endsection