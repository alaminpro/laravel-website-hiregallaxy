@extends('backend.layouts.master')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 float-left">Disciplines</h1>
  <div class="breadcrumb-holder float-right">
    <ol class="breadcrumb float-right">
      <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Disciplines</li>
    </ol>
    <div class="clearfix"></div>
  </div>
</div>


<div class="main-body">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card mb-3">
      <div class="card-header py-3">
        <div class="float-left">
          <h6 class="m-0 font-weight-bold text-primary">All Disciplines</h6>
        </div>
        <div class="float-right">
          @if (Route::is('admin.discipline.index'))
          <a href="{{ route('admin.discipline.trash') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i
              class="fas fa-trash fa-sm text-white-50"></i> Trash List</a>
          @elseif(Route::is('admin.discipline.trash'))
          <a href="{{ route('admin.discipline.index') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
              class="fas fa-check fa-sm text-white-50"></i> Active List</a>
          @endif

          <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#addModal"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add New discipline</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="card-body">
        @include('backend.partials.message')

        <div class="table-responsive">
          <table id="dataTable" width="100%" cellspacing="0" class="table table-bordered">
            <thead>
              <tr>
                <th width="5%">Sl</th>
                <th width="30%">Name</th>
                <th width="20%" style="Display:none;">Description</th>
                <th width="15%">Manage</th>
              </tr>
            </thead>
            <tbody>
              @if(count($disciplines) > 0)
              @foreach($disciplines as $discipline)
              <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>
                  {{ $discipline->name }}
                </td>
                <td style="Display:none;">{!! $discipline->description !!}</td>
                <td>
                  @if ($discipline->status == 1)
                  <a href="#editModal{{ $discipline->id }}" class="btn btn-circle btn-outline-success"
                    title="Edit discipline" data-toggle="modal"><i class="fa fa-edit"></i></a>
                  @endif

                  @if ($discipline->status == 0)
                  <a href="#activeModal{{ $discipline->id }}" class="btn btn-circle btn-outline-success"
                    title="Active discipline" data-toggle="modal"><i class="fa fa-check"></i></a>
                  @endif

                  <button class="btn btn-circle btn-outline-danger" data-toggle="modal"
                    data-target="#deleteModal{{ $discipline->id }}" title="Delete discipline"><i
                      class="fa fa-fw fa-trash"></i></button>

                  <!-- Delete Modal-->
                  <div class="modal fade" id="deleteModal{{ $discipline->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this discipline ?
                          </h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Please confirm if you want to delete</div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-secondary btn-sm" type="button"
                            data-dismiss="modal">Cancel</button>
                          <form class="" action="{{ route('admin.discipline.delete', $discipline->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i>
                              Confirm</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Activate Modal -->
                  <div class="modal fade" id="activeModal{{ $discipline->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Are you sure want to activate this discipline ?
                          </h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Please confirm if you want to activate</div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-secondary btn-sm" type="button"
                            data-dismiss="modal">Cancel</button>
                          <form class="" action="{{ route('admin.discipline.active', $discipline->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i>
                              Confirm</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                </td>
              </tr>

              <!-- Edit Modal -->
              <div class="modal" id="editModal{{ $discipline->id }}">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Edit discipline</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      <form action="{!! route('admin.discipline.update', $discipline->id) !!}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                          <div class="col-md-6 form-group">
                            <label for="name">Discipline Title <span class="text-danger required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                              placeholder="eg. Web Development" required value="{{ $discipline->name }}">
                          </div>
                          <div class="col-md-6 form-group" style="Display:none;">
                            <label for="slug">Discipline Slug <span class="text-info required">(optional)</span></label>
                            <input type="text" id="slug" name="slug" class="form-control"
                              placeholder="eg. web-development" value="{{ $discipline->slug }}">
                          </div>
                        </div>
                        <div class="form-row" style="Display:none;">
                          <div class="col-md-12 form-group">
                            <label for="description">Discipline Description</label>

                            <textarea name="description" id="description" name="description" rows="8" cols="80"
                              class="tinymce form-control">{{ $discipline->description }}</textarea>
                          </div>
                        </div>

                        <button type="button" class="btn btn-danger float-right mt-1 ml-2 " data-dismiss="modal"><i
                            class="fa fa-times"></i> Cancel</button>

                        <button type="submit" class="btn btn-success float-right mt-1 ">
                          <i class="fa fa-check"></i> Update
                        </button>

                      </form>
                    </div>

                  </div>
                </div>
              </div>
              <!-- Edit Modal -->

              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div><!-- end card-->
    </div>
  </div>
</div>


<!-- Add Modal -->
<div class="modal" id="addModal">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Discipline</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{!! route('admin.discipline.submit') !!}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-row">
            <div class="col-md-6 form-group">
              <label for="name">Discipline Title <span class="text-danger required">*</span></label>
              <input type="text" id="name" name="name" class="form-control" placeholder="" required>
            </div>
            <div class="col-md-6 form-group" style="Display:none;">
              <label for="slug">Discipline Slug <span class="text-info required">(optional)</span></label>
              <input type="text" id="slug" name="slug" class="form-control" placeholder="">
            </div>
          </div>
          <div class="form-row" style="Display:none;">
            <div class="col-md-12 form-group">
              <label for="description">Discipline Description</label>

              <textarea name="description" id="description" name="description" rows="8" cols="80"
                class="tinymce form-control"></textarea>
            </div>
          </div>

          <button type="button" class="btn btn-danger float-right mt-1 ml-2 " data-dismiss="modal"><i
              class="fa fa-times"></i> Cancel</button>

          <button type="submit" class="btn btn-success float-right mt-1 ">
            <i class="fa fa-check"></i> Add
          </button>

        </form>
      </div>

    </div>
  </div>
</div>

@endsection