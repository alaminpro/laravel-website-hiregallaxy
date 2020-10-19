<!-- Footer Section -->

 <section class="footer-section sec-pad">

	<div class="container">

		<div class="footer-area">

			<div class="row">

				<div class="col-md-3">

					<h1 class="footer-title text-uppercase">Company</h1>

					 
					<ul class="footer-links">

						<li>

							<a href="{{ route('about_us') }}"><i class="fa fa-caret-right"></i>About us</a>

						</li>

						<li>

							<a href="{{ route('contacts') }}"><i class="fa fa-caret-right"></i>Contact us</a>

						</li>
						

						</ul>

					</div> 
				<div class="col-md-3">

					<h1 class="footer-title text-uppercase">Terms</h1>

					<ul class="footer-links">

						<li>

							<a href="{{ route('terms') }}"><i class="fa fa-caret-right"></i>Terms of use</a>

						</li>

						<li>

							<a href="{{ route('privacy') }}"><i class="fa fa-caret-right"></i>Privacy Policy</a>

						</li>
						

						</ul>

				</div> 
				<div class="col-md-3">

					<h1 class="footer-title text-uppercase">Customer</h1>

					<ul class="footer-links">

						<li>

							<a href="{{ route('testimonial') }}"><i class="fa fa-caret-right"></i> Testimonials</a>

						</li> 
				
					</ul>

				</div>



				<div class="col-md-3">

					<h1 class="footer-title text-uppercase">Follow</h1>

					<div class="footer-social">

						<a href="{{ App\Models\Setting::first()->facebook_link ? App\Models\Setting::first()->facebook_link : '#' }}"><i class="fa fa-facebook facebook-icon"></i></a>

						<a href="{{ App\Models\Setting::first()->twitter_link ? App\Models\Setting::first()->twitter_link: '#' }}"><i class="fa fa-twitter twitter-icon"></i></a>

						<a href="{{ App\Models\Setting::first()->google_plus_link ? App\Models\Setting::first()->google_plus_link : '#' }}"><i class="fa fa-google-plus google-plus-icon"></i></a>

						<a href="{{ App\Models\Setting::first()->linkedin_link ? App\Models\Setting::first()->linkedin_link : '#' }}"><i class="fa fa-linkedin linkedin-icon"></i></a>

					</div>

				</div>

		</div>

	</div>

</div>

</section>



<!-- Apply Job Modals -->

@include('frontend.partials.apply-job-modal')

@include('frontend.partials.apply-update-job-modal')

<!-- Apply Job Modals -->





<div class="modal animated fadeIn" id="signInModal">

	@include('frontend.partials.signin-modal')

</div>



<section class="footer-bottom-section">  
	<div class="container text-center">

		&copy; {{ date('Y') }} Joblrs, All rights reseved

	</div>

</section>

<!-- Footer Section -->