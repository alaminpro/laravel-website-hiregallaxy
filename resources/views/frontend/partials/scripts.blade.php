<!-- Vue App JS -->  
<script>
    var ajax_url = '{{  route('ajax')  }}'; 
</script> 
<script src="{{ asset('js/app.js') }}"></script> 
 
<style>

	#preloader-status {

		background-image: url("{{ asset('images/preloader.gif')}}");

	}

</style>

<script>

	$(window).on('load', function(){

		$("#preloader-status").fadeOut();

		$("#preloader").delay(10).fadeOut("slow");

	});

</script>



<script type="text/javascript">

	$.ajaxSetup({

	    headers: {

	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	    }

	});

</script>

 

<!-- Custom -->

<script src="{{ asset('js/custom.js') }}?v={{ config('constants.asset_version') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<!-- Bootstrap Select Picker-->

<script src="{{ asset('js/bootstrap/bootstrap-select.min.js') }}"></script>

<script>

	$('.selectpicker').selectpicker();

</script>



<!-- Owl Carousel -->

<script src="{{ asset('js/owl-carousel/owl.carousel.min.js') }}"></script>



<!-- Parsley -->

<script src="{{ asset('js/parsley/parsley.min.js') }}"></script>



<!-- Noty -->

<script src="{{ asset('js/noty/noty.min.js') }}"></script>

@include('frontend.partials.flash-messages')



<!-- Jquery UI -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<!-- CkEditor -->

{{--  <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>  --}}





<style>

	.ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {

		height: 160px;

	}



	.ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,

	.ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {

		height: 160px;

	}

</style>



<!-- Apply Job Modal -->

<script src="{{ asset('admin-asset/js/tinymce/tiny_old.min.js') }}"></script>

<script>

	tinymce.init({

		selector: '#aboutCompanyDescription',

		height: 150,

		menubar: false,

		branding: false

	});



	tinymce.init({

		selector: '#about',

		height: 150,

		menubar: false,

		branding: false

	});



	tinymce.init({

		selector: '#apply_job_description',

		height: 150,

		menubar: false,

		branding: false

	});



	tinymce.init({

		selector: '#apply_job_description_update',

		height: 150,

		menubar: false,

		branding: false

	});



	$("#is_salary_negotiable").change(function(){

		

		var expected_salary = $("#expected_salary");



		if($(this).is(':checked')){

			expected_salary.removeAttr('required');

			expected_salary.attr('disabled', 'true');

		}else{

			expected_salary.removeAttr('disabled');

			expected_salary.attr('required', 'true');

		}

	});





	$("#use_profile_cv").change(function(){

		var cover_letter_cv = $("#cover_letter_cv");



		if($(this).is(':checked')){

			cover_letter_cv.attr('disabled', 'true');

		}else{

			cover_letter_cv.removeAttr('disabled');

		}

	});



	$("#use_profile_cv_update").change(function(){

		var cover_letter_cv = $("#cover_letter_cv_update");



		if($(this).is(':checked')){

			cover_letter_cv.attr('disabled', 'true');

		}else{

			cover_letter_cv.removeAttr('disabled');

		}

	});



	function applyJobDataSet(job_id, currency='USD', company_id) {

		$('#job_id_for_apply').val(job_id);
		$('#company_id_for_apply').val(company_id);

		$('#jobApplyCurrency').val(currency);

	}





	/**

	 * applyUpdateJobDataSet

	 *

	 * Works when user click on apply job and the job is updated

	 */



	 function applyUpdateJobDataSet(job_id, currency='USD', company_id) {

	 	$('#job_id_for_apply_update').val(job_id);
		 $('#company_id_update').val(company_id);
	 	$('#jobApplyCurrencyUpdate').val(currency);



	 	@if (Auth::check() && (Auth::user()->is_company== 0))

			// Fetch the data from server

			$.get( "{{ url('/') }}" +"/api/job-activity/get/"+job_id+"/"+{{ Auth::id() }})

			.done(function( data ) {

				data = JSON.parse(data);

				console.log(data);

				if(data.status == 'success'){

					var is_salary_negotiable = data.data.is_salary_negotiable;

					var expected_salary = data.data.expected_salary;

					var cover_letter = data.data.cover_letter;

					var cv = data.data.cv;

					var user_profile_cv = '{{ Auth::user()->candidate ? Auth::user()->candidate->cv : '' }}';

					if( cv == null){

						cv = user_profile_cv;

					}



					if(cv == user_profile_cv){

						$("#use_profile_cv_update").attr('checked', 'true');



						var cover_letter_cv = $("#cover_letter_cv_update");

						cover_letter_cv.attr('disabled', 'true');

					}



					if (user_profile_cv != null){

						if(cv.length != 0){

							$("#oldApplyCV").html("<a href='files/cv/"+cv+"' target='blank'><i class='fa fa-download'></i> Previous CV</a>")

						}

					}





					if(is_salary_negotiable == 1){

						$("#is_salary_negotiable_update").attr('checked', 'true');

						var expected_salary_update = $("#expected_salary_update");

						if($("#is_salary_negotiable_update").is(':checked')){

							expected_salary_update.removeAttr('required');

							expected_salary_update.attr('disabled', 'true');

						}else{

							expected_salary_update.removeAttr('disabled');

							expected_salary_update.attr('required', 'true');

						}

					}else{

						$("#expected_salary_update").val(expected_salary);

					}



					// text_editor.setData(cover_letter);

					tinymce.get("apply_job_description_update").setContent(cover_letter);



				}

			});

			@endif



		}



		$('#update-apply-job-modal').on('hidden.bs.modal', function () {

			

		})



		$("#is_salary_negotiable_update").change(function(){

			var expected_salary = $("#expected_salary_update");



			if($(this).is(':checked')){

				expected_salary.removeAttr('required');

				expected_salary.attr('disabled', 'true');

			}else{

				expected_salary.removeAttr('disabled');

				expected_salary.attr('required', 'true');

			}

		});	

		

		/** Subscriber Email **/ 

		$("#subscribe-button").click(function(){

			let email_address = $("#subscriber-email").val();

			var url_subscribe = "{{ url('/') }}/get-subscribed";

			if(email_address.length == 0){

				$("#subscriber-message").html("<div class='text-danger'>Please write your email address !!</div>")

			}else{

				$.post( url_subscribe, { email: email_address, '_token': "{{ csrf_token() }}" })

				.done(function( data ) {

					data = JSON.parse(data);

					if(data.status === 'success'){

						$("#subscriber-message").html("<div class='text-success'></div>")

						new Noty({

							theme: 'sunset',

							type: 'success',

							layout: 'topCenter',

							text: data.message,

							timeout: 3000

						  }).show();

						  $("#subscriber-email").val('');

						  $('#SubscriberModal').modal('toggle');

					}else{

						$("#subscriber-message").html("<div class='text-danger'>"+data.message+"</div>")

					}

				});

			}

		});

</script>



<!-- Wow -->

<script src="{{ asset('js/wow/wow.min.js') }}"></script>

<script>

	new WOW().init(); 

</script>

<!--dashboard nav bar -->

<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->

<script>
$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
});
</script>