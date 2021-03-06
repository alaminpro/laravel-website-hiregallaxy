<!-- Google Font -->
<link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

<link rel="shortcut icon" href="{{ asset('images/'.App\Models\Setting::first()->site_favicon) }}"

    type="image/x-icon">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
<link rel="stylesheet" href="{{ asset('css/font-awesome/font-awesome.min.css') }}"> 
<!-- Bootstrap Select Picker -->
<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap-select.min.css') }}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{ asset('css/animate/animate.min.css') }}">
<!-- Parsley -->
<link rel="stylesheet" href="{{ asset('css/parsley/parsley.css') }}?v={{ config('constants.asset_version') }}">
<!-- Noty -->
<link rel="stylesheet" href="{{ asset('css/noty/noty.css') }}">
<!-- Jquery UI -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="{{ asset('js/owl-carousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/owl-carousel/owl.theme.default.min.css') }}"> 
<link rel="stylesheet" href="{{ asset('css/jquery.mcustomscrollbar.css') }}"> 

<!-- script for datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="{{ asset('css/main.css') }}?v={{ config('constants.asset_version') }}"> 