@extends('layouts.app')

@section('title', __('Course'))

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
                        <li class="breadcrumb-item"><a href="{{url('school/sections?course=1')}}" style="color:#3b80ef;">@lang('All Classes') &amp; @lang('Sections')</a></li>
                        <li class=" breadcrumb-item active">@lang('Courses')</li>
                    </ol>
                </nav>
            @endif
            <h4>@lang('Courses Related to Section')</h4>
            <div class="card border-0" >
              @if(count($courses) > 0)
                @foreach ($courses as $course)
                     @break($loop->first)
                @endforeach
                <div class="card-body">
                    <h5 class="card-title"><b>@lang('Section')</b> -   {{$course->section->section_number}} &nbsp;<b>@lang('Class')</b> -  {{$course->section->class->class_number}}</h5>

                @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.course-table',['courses'=>$courses, 'exams'=>$exams, 'student'=>(Auth::user()->role == 'student')?true:false])
                    @endcomponent
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
