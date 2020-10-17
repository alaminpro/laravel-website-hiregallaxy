@extends('backend.layouts.master')







@section('content')



<div class="d-sm-flex align-items-center justify-content-between mb-4">

  <h1 class="h3 mb-0 float-left">Create Question</h1>

  <div class="breadcrumb-holder float-right">

    <ol class="breadcrumb float-right">

      <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>

      <li class="breadcrumb-item active">Create Question</li>

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

            Create Question

          </h6>

        </div>

        <div class="float-right">

          <a href="{{ url('admin/question') }}"

            class=" btn btn-sm btn-primary shadow-sm"><i

              class="fas fa-arrow-left fa-sm text-white-50"></i> All Questions</a>

        </div>

        <div class="clearfix"></div>

      </div>

      <div class="card-body">

        @include('backend.partials.message')

       <form class="js-validate" method="POST" action="{{route('admin.question.store')}}"  enctype="multipart/form-data">

            @csrf

          <div class="row">

            <!-- Input -->

            <div class="col-sm-12 mb-6">

                <div class="form-group">

                  <label id="questions" class="form-label">Question</label>

                  <textarea class="form-control question_editor" name="question" id="question" placeholder="Enter question" cols="30" rows="1" ></textarea>

                  <span class="text-danger">{{ $errors->has('question') ? $errors->first('question') : '' }}</span>

                </div>

            </div>

            <!-- End Input -->



            <!-- Input -->

            <div class="col-sm-6 mb-6">

                <div class="form-group">

                  <label id="nameLabel" class="form-label">Answer 1</label>

                  <!--<input type="text" class="form-control" name="answer_1" id="answer_1" placeholder="Enter answer" required>-->

                  <textarea cols="30" rows="1" class="form-control answer_1_editor" name="answer_1" id="answer_1" placeholder="Enter answer" ></textarea>

                </div>

            </div>

            <div class="col-sm-6 mb-6">

                <div class="form-group">

                  <label id="nameLabel" class="form-label">

                    Answer 2



                  </label>

                  <!--<input type="text" class="form-control" name="answer_2" id="answer_2" placeholder="Enter answer" required>-->

                  <textarea cols="30" rows="1" class="form-control answer_2_editor" name="answer_2" id="answer_2" placeholder="Enter answer" ></textarea>

                </div>

            </div>

            <div class="col-sm-6 mb-6">

                <div class="form-group">

                  <label id="nameLabel" class="form-label">

                    Answer 3



                  </label>

                  <!--<input type="text" class="form-control" name="answer_3" id="answer_3" placeholder="Enter answer" required>-->

                  <textarea cols="30" rows="1" class="form-control answer_3_editor" name="answer_3" id="answer_3" placeholder="Enter answer" ></textarea>

                </div>

            </div>

            <div class="col-sm-6 mb-6">

                <div class="form-group">

                  <label id="nameLabel" class="form-label">

                    Answer 4



                  </label>

                  <!--<input type="text" class="form-control" name="answer_4" id="answer_4" placeholder="Enter answer" required>-->

                  <textarea cols="30" rows="1" class="form-control answer_4_editor" name="answer_4" id="answer_4" placeholder="Enter answer" ></textarea>

                </div>

            </div>





            <div class="col-sm-6 mb-6">

                <div class="form-group">

                  <label id="skills" class="form-label">

                  Skills

                </label>

                  <select name="skills[]" id="skills" required class="form-control skillselect" multiple>



                    @foreach($skills as $skill)

                      <option value="{{$skill->id}}">{{$skill->name}}</option>

                    @endforeach

                  </select>

                </div>

                <div class="form-group">

                  <label id="exparience" class="form-label">

                    Exparience

                </label>

                  <select name="expariences[]" id="exparience" required class="form-control select2exp" multiple>

                    @foreach($experiences as $exparience)

                      <option value="{{$exparience->id}}">{{$exparience->name}}</option>

                    @endforeach

                  </select>

                </div>

            </div>



            <div class="col-sm-6 mb-6">

                <div class="form-group">

                  <label id="skills" class="form-label">

                  Right Answer

                </label>

                  <select name="right_answer" id="right_answer" required class="form-control">

                      <option value="">Select right answer</option>

                      <option value="answer_1">Answer 1</option>

                      <option value="answer_2">Answer 2</option>

                      <option value="answer_3">Answer 3</option>

                      <option value="answer_4">Answer 4</option>



                  </select>

                </div>

            </div>



            <!-- End Input -->

          </div>



          <div class="mt-3">

            <button type="button" class="btn btn-danger float-right mt-1 ml-2 " data-dismiss="modal"><i

                class="fa fa-times"></i> Cancel</button>



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

    var select2 = $('select.skillselect').select2();

     $('.select2exp').select2();

        CKEDITOR.replace('question', {

		    filebrowserUploadUrl: "{{asset('admin/questions/uploads?_token=' . csrf_token()) }}&type=file",

		    imageUploadUrl: "{{asset('admin/questions/uploads?_token='. csrf_token() )  }}&type=image",

            filebrowserBrowseUrl: "{{url('admin/question/file_browser') }}",

            filebrowserUploadMethod: 'form'

		});

		

		CKEDITOR.replace('answer_1', {

		    filebrowserUploadUrl: "{{asset('admin/questions/uploads?_token=' . csrf_token()) }}&type=file",

		    imageUploadUrl: "{{asset('admin/questions/uploads?_token='. csrf_token() )  }}&type=image",

            filebrowserBrowseUrl: "{{asset('admin/question/file_browser') }}",

            filebrowserUploadMethod: 'form'

		});

		

		CKEDITOR.replace('answer_2', {

		    filebrowserUploadUrl: "{{asset('admin/questions/uploads?_token=' . csrf_token()) }}&type=file",

		    imageUploadUrl: "{{asset('admin/questions/uploads?_token='. csrf_token() )  }}&type=image",

            filebrowserBrowseUrl: "{{asset('admin/question/file_browser') }}",

            filebrowserUploadMethod: 'form'

		});

		

		CKEDITOR.replace('answer_3', {

		    filebrowserUploadUrl: "{{asset('admin/questions/uploads?_token=' . csrf_token()) }}&type=file",

		    imageUploadUrl: "{{asset('admin/questions/uploads?_token='. csrf_token() )  }}&type=image",

            filebrowserBrowseUrl: "{{asset('admin/question/file_browser') }}",

            filebrowserUploadMethod: 'form'

		});

		

		CKEDITOR.replace('answer_4', {

		    filebrowserUploadUrl: "{{asset('admin/questions/uploads?_token=' . csrf_token()) }}&type=file",

		    imageUploadUrl: "{{asset('admin/questions/uploads?_token='. csrf_token() )  }}&type=image",

            filebrowserBrowseUrl: "{{asset('admin/question/file_browser') }}",

            filebrowserUploadMethod: 'form'

		});



  });

</script>





@endsection

