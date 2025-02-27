@extends('layouts.app')

@section('title', __('Staff Attendance'))

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg" id="main-container">
                @if (session('error'))
                    <div class="alert mt-3 alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
<h4 class="p-2 ">{{$subject_details->name}}  &nbsp;  Class-{{ $subject_details->class_number }} &nbsp; Section-{{ $subject_details->section_number }}  </h4>
                <div class="card  mt-4 overflow-hidden border-yellow ">
                    <div class="card-header text-white bg-yellow"><h5 class="mb-0" > Create Assignment </h5> </div>

                    <div class="card-body  ">
                        <form method="post" action="/assignment/submit"  enctype='multipart/form-data'>
                            @csrf
                            <input type="hidden" name="teacher_subject_id" value="{{$subject_details->teacher_subject_id}}">
                            <div class="form-group">
                                <label for="title">Assignment</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Assignment Title" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" required ></textarea>
                            </div>

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="attachment" class="custom-file-input"  id="inputGroupFile04">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>

                                </div>

                            </div><small class="d-block text-danger">Max File Size 5MB</small>

                            <div class="form-group col-4 pl-0 mt-3">
                                <label for="due_date">Due Date</label>
                                <input  class="form-control datepicker" id="due_date" name="due_date" autocomplete="off" required >
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 pl-0">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                    <div class="card  mt-4 overflow-hidden border-0 ">
                        <div class="card-header text-white bg-brown"><h5 class="mb-0" >  Assignment List </h5> </div>

                        <div class="card-body p-0 b-0 ">
                            <table class="table table-bordered">
                                <thead class="thead">
                                <tr>

                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Teacher Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">View details</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($assignments as $assignment)
                                    <tr>

                                        <td>{{$assignment->name}}</td>

                                        @if(isset($assignment->teacher_name))
                                            <td>{{$assignment->teacher_name}}</td>
                                            <td>{{$assignment->title}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-messenger" href='/assignment/submissions/{{$assignment->assignment_id}}' >
                                                    View submissions
                                                </a>
                                            </td>
                                        @else
                                            <td class="text-danger"> Not assigned </td>
                                            <td>
                                                -
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>


            </div>
        </div>
    </div>
    <script>

        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate:'today'
        });

        $('#inputGroupFile04').on('change',function(){
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>

    </div>



@endsection
