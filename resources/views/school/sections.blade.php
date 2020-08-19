@extends('layouts.app')

@section('title', __('All Classes and Sections'))

@section('content')
<style>
    #cls-sec .panel{
        margin-bottom: 0%;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg" id="main-container">
            <h2>@lang('All Classes and Sections')</h2>
            <div id="accordion">
                <div class="card border-0" id="cls-sec">
              @if(count($classes) > 0)
                @foreach ($classes as $class)
                    <div class="card border-0">
                        <div class="card-title" id="heading{{$class->id}}">
                                <div class="row">
                                    <h4 class="col-md-4">
                                        <a class="card-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}">{{$class->class_number}} {{ucfirst($class->group)}}</a>
                                    </h4>
                                    <h4 class="col-md-4">
                                        <a class="card-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}"><small><b>@lang('Click to view all Sections under this Class') <i class="material-icons">keyboard_arrow_down</i></b></small></a>
                                    </h4>
                                    @if(isset($_GET['course']) && $_GET['course'] == 1)
                                    <div class="col-md-4">
                                        <a role="button" class="btn btn-info btn-sm " href="{{url('academic/syllabus/'.$class->id)}}"><i class="material-icons">visibility</i> @lang('View Syllabus for this Class')</a>
                                    </div>
                                    @endif
                                </div>
                        </div>

                        <div id="collapse{{$class->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$class->id}}">
                            <div class="card-body">
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>@lang('Section Name')</th>
                                            @if(isset($_GET['att']) && $_GET['att'] == 1)
                                            <th>@lang('View Today\'s Attendance')</th>
                                            <th>@lang('View Each Student\'s Attendance')</th>
                                            <th>@lang('Give Attendance')</th>
                                            @endif
                                            @if(isset($_GET['course']) && $_GET['course'] == 1)
                                            <th>@lang('View Courses')</th>
                                            <th>@lang('View Students')</th>
                                            <th>@lang('View Routines')</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sections as $section)
                                            @if($class->id == $section->class_id)
                                            <tr>
                                            <td>
                                                <a href="{{url('courses/0/'.$section->id)}}">{{$section->section_number}}</a>
                                            </td>
                                            @if(isset($_GET['att']) && $_GET['att'] == 1)
                                                @foreach ($exams as $ex)
                                                    @if ($ex->class_id == $class->id)
                                                        <td>
                                                            <a role="button" class="btn btn-primary btn-sm" href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}"><i class="material-icons">visibility</i> @lang('View Today\'s Attendance')</a>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            <td>
                                                <a role="button" class="btn btn-danger btn-sm" href="{{url('attendances/'.$section->id)}}"><i class="material-icons">visibility</i> @lang('View Each Student\'s Attendance')</a>
                                            </td>
                                            <td>
                                                <?php
                                                    $ce = 0;    
                                                ?>
                                                @foreach ($exams as $ex)
                                                    @if ($ex->class_id == $class->id)
                                                        <?php
                                                            $ce = 1;
                                                        ?>
                                                        <a role="button" class="btn btn-info btn-sm" href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}"><i class="material-icons">spellcheck</i> @lang('Take Attendance')</a>
                                                    @endif
                                                @endforeach
                                                @if($ce == 0)
                                                    @lang('Assign Class Under Exam')
                                                @endif
                                            </td>
                                            @endif
                                            @if(isset($_GET['course']) && $_GET['course'] == 1)
                                            <td>
                                                <a role="button" class="btn btn-info btn-sm" href="{{url('courses/0/'.$section->id)}}"><i class="material-icons">visibility</i> @lang('View Courses under this section')</a>
                                            </td>
                                            <td>
                                                <a role="button" class="btn btn-danger btn-sm" href="{{url('section/students/'.$section->id.'?section=1')}}"><i class="material-icons">visibility</i> @lang('View Students of this section')</a>
                                            </td>
                                            <td>
                                                <a role="button" class="btn btn-primary btn-sm" href="{{url('academic/routine/'.$section->id)}}"><i class="material-icons">visibility</i> @lang('View Routines for this section')</a>
                                            </td>
                                            @endif
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
              @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>
            </div>
          </div>

    </div>
</div>
@endsection
