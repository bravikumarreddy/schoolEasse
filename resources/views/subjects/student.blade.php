@extends('layouts.app')

@section('title', __('Course'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>

            <div class="col-md-10" id="main-container">


                <div class="card border-0" >
                    <div class="card-body">
                        <h4 class="card-title"> @lang('Courses Related to Section')</h4>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>

                                <th scope="col">Name</th>
                                <th scope="col">Section</th>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Assignments</th>
                            </tr>
                            </thead>
                            <tbody>

                           @foreach($subjects as $subject)
                            <tr>

                                <td>{{$subject->name}}</td>
                                <td>{{$subject->section_number}}</td>

                                @if(isset($subject->teacher_name))
                                    <td>{{$subject->teacher_name}}</td>
                                    <td>

                                        <a class="btn btn-sm btn-messenger" href='/assignment/student/{{$subject->teacher_subject_id}}' >
                                            Assignments
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
@endsection
