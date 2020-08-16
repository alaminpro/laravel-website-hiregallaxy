<!-- Footer Section -->
{{--  <section class="footer-section sec-pad">
	<div class="container">
		<div class="footer-area">
			<div class="row">
				<div class="col-md-3">
					<h3 class="footer-title">About HireGallaxy</h3>
					<p>
						Phase the a at written writers, of a royal sort my to looked. Magazine guest world lift apprehend all into cheerful.
					</p>
					<p class="mt-3">
						<i class="fa fa-map-marker"></i> 
						<span class="ml-3">
							North Avenue 12/7, Stack Block, Sydney, Australia
						</span>
					</p>
					<p>
						<i class="fa fa-envelope"></i> <a href="mailto:info@hiregallaxy.com" class="ml-3">info@hiregallaxy.com</a>
					</p>
					<p>
						<i class="fa fa-phone"></i>
						<span class="ml-3">
							+1230293239230
						</span>
					</p>
					<div class="footer-social">
						<a href=""><i class="fa fa-facebook facebook-icon"></i></a>
						<a href=""><i class="fa fa-twitter twitter-icon"></i></a>
						<a href=""><i class="fa fa-google-plus google-plus-icon"></i></a>
						<a href=""><i class="fa fa-linkedin linkedin-icon"></i></a>
					</div>
				</div>
				<div class="col-md-3">
					<h3 class="footer-title">About HireGallaxy</h3>
					<ul class="footer-links">
						<li>
							<a href=""><i class="fa fa-caret-right"></i> Short Code</a>
						</li>
						<li>
							<a href="{{ route('jobs') }}"><i class="fa fa-caret-right"></i> Job Pages</a>
</li>
<li>
	<a href="#"><i class="fa fa-caret-right"></i> Resume</a>
</li>
<li>
	<a href="#"><i class="fa fa-caret-right"></i> Blog</a>
</li>
<li>
	<a href="{{ route('contacts') }}"><i class="fa fa-caret-right"></i> Contact</a>
</li>
</ul>
</div>

<div class="col-md-3">
	<h3 class="footer-title">For Cadidates</h3>
	<ul class="footer-links">
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Short Code</a>
		</li>
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Job Pages</a>
		</li>
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Resume</a>
		</li>
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Blog</a>
		</li>
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Contact</a>
		</li>
	</ul>
</div>

<div class="col-md-3">
	<h3 class="footer-title">For Company</h3>
	<ul class="footer-links">
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Short Code</a>
		</li>
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Job Pages</a>
		</li>
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Resume</a>
		</li>
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Blog</a>
		</li>
		<li>
			<a href=""><i class="fa fa-caret-right"></i> Contact</a>
		</li>
	</ul>
</div>
</div>
</div>
</div>
</section> --}}

<!-- Apply Job Modals -->
@include('frontend.partials.apply-job-modal')
@include('frontend.partials.apply-update-job-modal')
<!-- Apply Job Modals -->


<div class="modal animated fadeIn" id="signInModal">
	@include('frontend.partials.signin-modal')
</div>

<section class="footer-bottom-section">
    <div>
        <a href="{{ route('terms') }}" class="text-white">Terms and Service</a>
        <a href="{{ route('privacy') }}" class="text-white ml-2">Privacy Policy</a>
    </div>
	<div class="container text-center">
		&copy; {{ date('Y') }} HireGallaxy, All rights reseved
	</div>
</section>
<!-- Footer Section -->