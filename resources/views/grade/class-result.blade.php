@extends('layouts.app')

@section('title', __('Grade'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-lg" id="main-container">
            @if(Auth::user()->role != 'student')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="margin-top: 3%;">
                        <li class="breadcrumb-item" ><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">@lang('Grades')</a></li>
                        <li class="breadcrumb-item active">@lang('Section Grade')</li>
                    </ol>
                </nav>
            @endif
            <h2>@lang('Marks and Grades')</h2>
            <div class="card border-0">
              @if(count($grades) > 0)
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($grades as $grade)
                        <b>@lang('Class'):</b> {{$grade->course->class->class_number}} &nbsp;
                        <b>@lang('Section'):</b> {{$grade->student->section->section_number}}
                        @break
                    @endforeach
                    <table class="table table-data-div table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="row">@lang('Exam Name')</th>
                            <th scope="row">@lang('Course Name')</th>
                            <th scope="row">@lang('Student Code')</th>
                            <th scope="row">@lang('Student Name')</th>
                            <th scope="row">@lang('Total Mark')</th>
                            <th scope="row">@lang('GPA')</th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach($grades as $grade)
                        <tr>
                            <td>{{$grade->exam->exam_name}}</td>
                            <td>{{$grade->course->course_name}}</td>
                            <td>{{$grade->student->student_code}}</td>
                            <td><a href="{{url('user/'.$grade->student->student_code)}}">{{$grade->student->name}}</a></td>
                            <td>{{$grade->marks}}</td>
                            <td>{{$grade->gpa}}</td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
              @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
