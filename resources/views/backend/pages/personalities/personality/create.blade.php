@extends('backend.layouts.master')



@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 float-left">Create Personality Type</h1>
  <div class="breadcrumb-holder float-right">
    <ol class="breadcrumb float-right">
      <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Create Personality Type</li>
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
            Create Personality Type
          </h6>
        </div>
        <div class="float-right">
          <a href="{{ route('admin.personality.index') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
              class="fas fa-arrow-left fa-sm text-white-50"></i> All  Personality</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="card-body">
        @include('backend.partials.message')
       <form class="js-validate" method="POST" action="{{route('admin.personality.submit')}}"  >
            @csrf
          <div class="row">
            <!-- Input -->
            <div class="col-sm-12 mb-6">
                <div class="form-group">
                    <label id="title" class="form-label">Question</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Personality Title" required>
                    <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                 </div>
                <div class="form-group">
                    <label id="sub_title" class="form-label">Sub title</label>
                    <input type="text" class="form-control" name="sub_title" id="sub_title" placeholder="Enter Personality Sub Title">
                 </div>
                <div class="form-group">
                    <label id="description" class="form-label">Descrition</label>
                    <textarea name="description" id="description"  class="form-control"   cols="30" rows="5"></textarea>
                 </div>
                <div class="form-group">
                    <label id="strength" class="form-label">Strengths</label>
                    <textarea name="strengths" id="strength"  class="form-control"   cols="30" rows="5"></textarea>
                 </div>
                <div class="form-group">
                    <label id="weaknesse" class="form-label">Weaknesses</label>
                    <textarea name="weaknesses" id="weaknesse"  class="form-control"   cols="30" rows="5"></textarea>
                 </div>
            </div>
            <!-- End Input -->
          </div>

          <div class="mt-3">
            <a href="{{ route('admin.personality.index') }}" class="btn btn-danger float-right mt-1 ml-2 "><i
                class="fa fa-times"></i> Cancel</a>
            <button type="submit" class="btn btn-success float-right mt-1 ">
              <i class="fa fa-check"></i> Save
            </button>

          </div>


          <!-- End Buttons -->
        </form>
      </div><!-- end card-->
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function(){ 
     CKEDITOR.replace('strengths');
     CKEDITOR.replace('weaknesses'); 
  });
</script>


@endsection


