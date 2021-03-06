@extends('backend.auth.master')

@section('stylesheets')
<style>
  .bg-login-image {
    background: url("{{ asset('public/admin-asset/img/bg-login-image.png') }}");
    background-position: center;
    background-size: cover;
  }
</style>
@endsection

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
              </div>
              @if (Session::has('login_error'))
              <div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {!! Session::get('login_error') !!}
              </div>
              @endif
              <form class="user" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp"
                    name="email" placeholder="Enter Email Address...">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="password" placeholder="Password"
                    name="password">
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="customCheck">
                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Login
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{ route('admin.password.request') }}">Forgot Password?</a>

                <br>
                <br>
                <p>©{{ date('Y') }} All Rights Reserved. Hire Gallaxy</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection