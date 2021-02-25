@extends('backend.layouts.master') 



@section('content')



<div class="d-sm-flex align-items-center justify-content-between mb-4">

  <h1 class="h3 mb-0 float-left">Edit {{ $edit->username }} info</h1>

  <div class="breadcrumb-holder float-right">

    <ol class="breadcrumb float-right">

      <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>

      <li class="breadcrumb-item active">Edit {{ $edit->username }} info</li>

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

            Edit, {{ $edit->username }} info

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

       <form class="js-validate" method="POST" action="{{route('admin.account.update', $edit->id)}}"  enctype="multipart/form-data">

            @csrf

          



            <div class="row">

                <div class="col-lg-8">

                    <div class="form-group">

                        <label id="first_name" class="form-label">First Name <span class="text-danger">(Optional)</span></label>

                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name" value="{{ $edit->first_name }}">

                    </div>

                    <div class="form-group">

                        <label id="last_name" class="form-label">Last Name <span class="text-danger">(Optional)</span></label>

                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name" value="{{ $edit->last_name }}">

                    </div>

                    <div class="form-group">

                        <label id="username" class="form-label">Username <span class="text-danger">(Required)</span></label>

                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required value="{{ $edit->username }}">

                    </div>

                    <div class="form-group">

                        <label id="email" class="form-label">Email <span class="text-danger">(Required)</span></label>

                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required value="{{ $edit->email }}">

                    </div>

                    <div class="form-group">

                        <label id="phone" class="form-label">Phone <span class="text-danger">(Optional)</span></label>

                        <input type="number" class="form-control" name="phone_no" id="phone" placeholder="Enter phone number" value="{{ $edit->phone_no }}">

                    </div>

                    <div class="form-group">

                        <label id="address" class="form-label">Address <span class="text-danger">(Optional)</span></label>

                        <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ $edit->address }}</textarea>

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

                        <br>

                        @if($edit->image != null)

                            <img src="{{ asset('uploads/admins').'/'.$edit->image }}" alt="{{ $edit->username }} photo" width="120">

                            @else

                            <p>Photo not found!</p>

                        @endif

                      </div>

                    <div class="form-group">

                        <label id="image" class="form-label">Roles <span class="text-danger">(Required)</span></label>

                        <div class="roles">

                           

                            @foreach($roles as $role)

                                @foreach($edit->role as $r)

                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="role" {{  $r->id === $role->id ? 'checked': '' }} id="role-{{$role->id}}" value="{{ $role->id }}" >

                                    <label class="form-check-label" for="role-{{$role->id}}">

                                        {{ $role->name }}

                                    </label>

                                </div>

                                @endforeach

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



 