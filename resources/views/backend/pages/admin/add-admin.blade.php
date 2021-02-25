@extends('backend.layouts.master') 

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 float-left">Create new admin</h1>
  <div class="breadcrumb-holder float-right">
    <ol class="breadcrumb float-right">
      <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Create admin</li>
    </ol>
    <div class="clearfix"></div>
  </div>
</div>


<div class="main-body">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card mb-3">
      <div class="card-header py-3">
        <div class="float-left">
          <h6 class="m-0 font-weight-bold text-primary">
            Create Admin
          </h6>
        </div>
        <div class="float-right">
          <a href="{{ route('admin.account.index') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
              class="fas fa-arrow-left fa-sm text-white-50"></i> All Admins</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="card-body">
        @include('backend.partials.message')
       <form class="js-validate" method="POST" action="{{route('admin.account.store')}}"  enctype="multipart/form-data">
            @csrf
          

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label id="first_name" class="form-label">First Name <span class="text-danger">(Optional)</span></label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name" value="{{ old('first_name')}}">
                    </div>
                    <div class="form-group">
                        <label id="last_name" class="form-label">Last Name <span class="text-danger">(Optional)</span></label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name" value="{{ old('last_name')}}">
                    </div>
                    <div class="form-group">
                        <label id="username" class="form-label">Username <span class="text-danger">(Required)</span></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required value="{{ old('username')}}">
                    </div>
                    <div class="form-group">
                        <label id="email" class="form-label">Email <span class="text-danger">(Required)</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required value="{{ old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">(Required)</span></label>
                        <input type="password" class="form-control" name="password" id="passwordEm" placeholder="Write A Strong Password" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password <span class="text-danger">(Required)</span></label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Write Password Again" minlength="8" data-parsley-equalto="#passwordEm" required>
                    </div>
                    <div class="form-group">
                        <label id="phone" class="form-label">Phone <span class="text-danger">(Optional)</span></label>
                        <input type="number" class="form-control" name="phone_no" id="phone" placeholder="Enter phone number" value="{{ old('phone_no')}}">
                    </div>
                    <div class="form-group">
                        <label id="address" class="form-label">Address <span class="text-danger">(Optional)</span></label>
                        <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ old('address')}}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        <button type="button" onclick="location.href='{{ route('admin.account.index') }}'" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label id="image" class="form-label">Upload Image <span class="text-danger">(Optional)</span></label>
                        <input type="file" class="form-control" name="image" id="image">
                      </div>
                    <div class="form-group">
                        <label id="image" class="form-label">Roles <span class="text-danger">(Required)</span></label>
                        <div class="roles">
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role-{{$role->id}}" value="{{ $role->id }}" >
                                    <label class="form-check-label" for="role-{{$role->id}}">
                                    {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach 
                        </div>
                      </div>
                </div>
            </div>
       
          
        </form>
      </div><!-- end card-->
    </div>
  </div>
</div>

@endsection

 
