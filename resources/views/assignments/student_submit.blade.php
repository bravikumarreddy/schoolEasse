@extends('layouts.app')

@section('title', __('Staff Attendance'))

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg" id="main-container">

                @if($assignment->submission_id !== null)
                    <div class="alert mt-3 alert-success">
                        Assignment Already Submitted
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert mt-3 alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                    <div class="card  mt-4 overflow-hidden border-brown ">
                        <div class="card-header text-white bg-brown"><h5 class="mb-0" > Assignment Details </h5> </div>

                        <div class="card-body  ">
                            <h3 class="pt-2 mt-2 ">{{$assignment->title}}  &nbsp;  </h3>
                            <h5 class= "mt-4">{{$assignment->description}} </h5>
                            @if($assignment->url_path)
                                <div class="input-group mt-3">

                                    <a class=" btn p-2 bg-success text-white" download
                                       href="{{ url($assignment->url_path) }}"><i class="material-icons">cloud_download</i>
                                        <span class="nav-link-text p-2">Download File Attachment</span>
                                    </a>

                                </div>
                            @endif
                        </div>
                    </div>
                    @if($assignment->submission_id == null)
                <div class="card  mt-4 overflow-hidden border-pink ">
                    <div class="card-header text-white bg-pink"><h5 class="mb-0" > Submit </h5> </div>

                    <div class="card-body  ">
                        <form method="post" action="/assignment/student/submit/{{$assignment->id}}"  enctype='multipart/form-data'>
                            @csrf

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="attachment" class="custom-file-input"  id="inputGroupFile04">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>

                                </div>

                            </div><small class=" pl-3 pt-1 mb-4 d-block text-danger">Max File Size 5MB</small>


                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" required ></textarea>
                            </div>





                            <div class="form-group">
                                <div class="col-sm-8 pl-0">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                    @endif

            </div>
        </div>
    </div>
    <script>

        $('#inputGroupFile04').on('change',function(){
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>

    </div>



@endsection
