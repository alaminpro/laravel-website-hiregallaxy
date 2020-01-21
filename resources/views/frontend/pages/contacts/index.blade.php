{{-- AIzaSyBNr5i9I5FDjejRlffwoNT21LhLpduSGdg --}}
@extends('frontend.layouts.master')

@section('title')
Job Details | Hire Gallaxy
@endsection


@section('stylesheets')
<style>
	#map {
		height: 400px;
		/* The height is 400 pixels */
		width: 100%;
		/* The width is the width of the web page */
	}
</style>
@endsection


@section('content')
<section class="employer-page contact-page">
	<div class="header-company-profile">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1994.5599547346028!2d-111.87951918408517!3d60.00579038190064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53c989166ee410d9%3A0xe901a8a21b2f1dc9!2sService+Canada+Centre!5e0!3m2!1sen!2sbd!4v1566398880225!5m2!1sen!2sbd"
					width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> </div>
		</div>
	</div>
	<div class="container sec-pad">
		<div class="row">
			<div class="col-sm-8">
				<div class="contact-detail-main">
					<h5 class="text-theme font18 bold">
						We like to hear from you !!
					</h5>
					<div id="contact-form-area">
						<form action="{{ route('contacts.store') }}" class="mt-4" method="post" data-parsley-validate>
							@csrf
							<input type="hidden" name="is_admin" value="1">
							<div class="row form-group">
								<div class="col">
									<label for="full_name">Full Name <span class="required">*</span></label>
									<div class="input-group mb-3">
										<input type="text" class="form-control" placeholder="Write your name" id="name"
											name="name" required>
										<div class="input-group-append">
											<span class="input-group-text"><i class="fa fa-user"></i></span>
										</div>
									</div>
								</div>
								<input type="hidden" name="to_user_id" value="15">
								<div class="col">
									<label for="email">Email Address <span class="required">*</span></label>
									<div class="input-group mb-3">
										<input type="email" class="form-control" placeholder="Write your email address"
											id="email" name="email" required>
										<div class="input-group-append">
											<span class="input-group-text"><i class="fa fa-envelope"></i></span>
										</div>
									</div>
								</div>
							</div>

							<div class="row form-group">
								<div class="col">
									<label for="full_name">Subject <span class="required">*</span></label>
									<div class="input-group mb-3">
										<input type="text" class="form-control" placeholder="Write your Subject"
											id="name" name="subject" required>
										<div class="input-group-append">
											<span class="input-group-text"><i class="fa fa-edit"></i></span>
										</div>
									</div>
								</div>
							</div>

							<div class="row form-group">
								<div class="col">
									<label for="message">Your Message <span class="required">*</span></label>
									<textarea name="message" id="message" rows="5" class="form-control"
										placeholder="Write Your Message" required></textarea>
								</div>
							</div>

							<div class="row form-group">
								<div class="col">
									<input type="submit" class="btn apply-now-button font16" value="Send Message" />
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="employer-detail-sidebar contact-sidebar">
					<h5 class="text-theme">
						Contact Information
					</h5>

					<p class="ml-1 mt-3 text-theme">
						Shall switching blue write that apartment, that hung having the of fitted.
					</p>

					<p class="ml-4 mt-3 text-theme">
						<i class="fa fa-envelope mr-3 font20"></i> <a href="mailto:sabujdattabd@gmail.com"
							class="text-theme">sabujdattabd@gmail.com</a>
					</p>

					<p class="ml-4 mt-3 text-theme">
						<i class="fa fa-phone mr-3 font20"></i> <a href="tel:+(88) 01951233084" class="text-theme">+(88)
							01951233084</a>
					</p>

					<p class="ml-4 mt-3 text-theme">
						<i class="fa fa-fax mr-3 font20"></i> <a href="tel:+(88) 01951233084"
							class="text-theme">1-2038293823723</a>
					</p>

					<p class="ml-4 mt-3 text-theme">
						<i class="fa fa-map-marker mr-3 font20"></i> North Avenue, AX, Canada
					</p>

					<div class="mt-3 text-center">
						<div class="footer-social">
							<a href=""><i class="fa fa-facebook facebook-icon"></i></a>
							<a href=""><i class="fa fa-twitter twitter-icon"></i></a>
							<a href=""><i class="fa fa-google-plus google-plus-icon"></i></a>
							<a href=""><i class="fa fa-linkedin linkedin-icon"></i></a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
@endsection


@section('scripts')
<script>
	function initMap() {

		var canada = {lat: 55.585901, lng: -105.750596};

		var map = new google.maps.Map(
			document.getElementById('map'), {
				zoom: 4, center: canada
			});
		var marker = new google.maps.Marker({position: canada, map: map});
	}
</script>
{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1CiLnpV_HJb9NYaaEa-0dPEueVXvPSoE&callback=initMap"></script>
--}}
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDPIIpJ0Op0cnkUYoa_btm-Qde-bOfs1k&callback=initMap">

</script>
@endsection