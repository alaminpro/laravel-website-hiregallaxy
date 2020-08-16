<!-- Google Font -->
<link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

<link rel="shortcut icon" href="{{ asset('public/images/'.App\Models\Setting::first()->site_favicon) }}"

    type="image/x-icon">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="{{ asset('public/css/font-awesome/font-awesome.min.css') }}">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('public/css/bootstrap/bootstrap.min.css') }}">
<!-- Bootstrap Select Picker -->
<link rel="stylesheet" href="{{ asset('public/css/bootstrap/bootstrap-select.min.css') }}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{ asset('public/css/animate/animate.min.css') }}">
<!-- Parsley -->
<link rel="stylesheet" href="{{ asset('public/css/parsley/parsley.css') }}?v={{ config('constants.asset_version') }}">
<!-- Noty -->
<link rel="stylesheet" href="{{ asset('public/css/noty/noty.css') }}">
<!-- Jquery UI -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="{{ asset('public/js/owl-carousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/js/owl-carousel/owl.theme.default.min.css') }}">

<!--  for left navigation 
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> -->
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('public/css/custom/main.min.css') }}?v={{ config('constants.asset_version') }}">

<!-- script for datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  
<!--new
<link rel="stylesheet" href="{{ asset('public/css/custom/custom.css') }}">-->