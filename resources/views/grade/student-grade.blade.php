@extends('layouts.app')

@section('title', __('Grade'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if(Auth::user()->role != 'student')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="margin-top: 3%;">
                        <li class="breadcrumb-item" ><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">@lang('Grades')</a></li>
                        <li class="breadcrumb-item" ><a href="{{url()->previous()}}" style="color:#3b80ef;">@lang('Section Students')</a></li>
                        <li class="breadcrumb-item active">@lang('History')</li>
                    </ol>
                </nav>
            @endif
            <h4 class="p-3">@lang('Marks and Grades History')</h4>
            <div class="card border-0">
              @if(count($grades) > 0)
              @foreach ($grades as $grade)
                <?php
                    $studentName = $grade->student->name;
                    $classNumber = $grade->student->section->class->class_number;
                    $sectionNumber = $grade->student->section->section_number;
                ?>
                 @break($loop->first)
                    <h4 class="card-title"><b>@lang('Student Code')</b> - {{$grade->student->student_code}} &nbsp;<b>@lang('Name')</b> -  {{$grade->student->name}} &nbsp;<b>@lang('Class')</b> - {{$grade->student->section->class->class_number}} &nbsp;<b>@lang('Section')</b> - {{$grade->student->section->section_number}}</h4>

                    @endforeach
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('layouts.student.grade-table')
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
