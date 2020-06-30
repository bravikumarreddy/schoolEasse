@extends('layouts.app')

@section('title', __('Course Students'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin-top: 3%;">
                    @if(isset($_GET['grade']) && $_GET['grade'] == 1)
                        <li class="breadcrumb-item" ><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">@lang('Grades')</a></li>
                    @else
                        <li class="breadcrumb-item" ><a href="{{url('school/sections?course=1')}}" style="color:#3b80ef;">@lang('Section')</a></li>
                    @endif
                    <li class="breadcrumb-item active">@lang('Students')</li>
                </ol>
            </nav>
            <h4>@lang('Section Students')</h4>
            <div class="card border-0">
              @if(count($students) > 0)
                <div class="card-body">
                    <table class="table table-sm table-hover table-striped">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Sl.')</th>
                            <th scope="col">@lang('Student Code')</th>
                            <th scope="col">@lang('Student Name')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Grade History')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{($loop->index+1)}}</td>
                            <td>{{$student->student_code}}</td>
                            <td><a href="{{url('user/'.$student->student_code)}}">{{$student->name}}</a></td>
                            <td>
                            @if(isset($student->studentInfo['session']) && ($student->studentInfo['session'] == now()->year || $student->studentInfo['session'] > now()->year))
                            <span class="badge badge-success">@lang('Promoted/New')</span>
                            @else
                            <span class="badge badge-danger">@lang('Not Promoted')</span>
                            @endif
                            </td>
                            <td><a class="btn btn-sm btn-success pt-0 pb-0 pl-1 pr-1" role="button" href="{{url('grades/'.$student->id)}}">@lang('View Grade History')</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              @else
                <div class="card-body">
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
