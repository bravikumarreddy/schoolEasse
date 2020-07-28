@extends('layouts.app')

@section('title', __('Staff Attendance'))

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>

            <div class="col-md-10" id="main-container">
                @if (session('error'))
                    <div class="alert mt-3 alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
{{--                <h4 class="p-2 ">{{$subject_details->name}}  &nbsp;  Class-{{ $subject_details->class_number }} &nbsp; Section-{{ $subject_details->section_number }}  </h4>--}}
                <div class="card  mt-4 overflow-hidden border-0 ">
                    <div class="card-header text-white bg-yellow"><h5 class="mb-0" >  Assignment List </h5> </div>

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
                                            <a class="btn btn-sm btn-messenger" href='/assignment/student/submit/{{$assignment->assignment_id}}' >
                                               View details
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


    </script>

    </div>



@endsection
