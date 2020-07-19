@extends('layouts.app')

@section('content')
<style>
    .badge-download {
        background-color: transparent !important;
        color: #464443 !important;
    }
    .list-group-item-text{
      font-size: 12px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>

        <div class="col-md-10" id="main-container">
            <div class="pt-3 card border-0 " >
                <h3 class="card-title">@lang('Dashboard')</h3>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                        @if(Auth::user()->role == 'admin')
                            <div class="row ">
                                <div class="col-3 mb-3 pb-3">
                                    <div style="width: 150px; height: 150px; float: left; position: relative;">
                                        <canvas id="doughnut" width="100px" height="100px"></canvas>
                                        <div
                                            style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                                            <h4 class="m-0"><b>{{$totalStudents - $studentsFullDay}}</b></h4>
                                            <small>Students present  </small><br/>
                                            <small>out of {{$totalStudents}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    <div class="row ">

                        <div class="col-sm-2">
                            <button type="button" class="btn btn-lg btn-primary" >
                                @lang('Students') - <b>{{$totalStudents}}</b>
                            </button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-lg btn-success" >
                                @lang('Teachers') - <b>{{$totalTeachers}}</b>
                            </button>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-lg btn-info">
                                @lang('Types of Books In Library') - <b>{{$totalBooks}}</b>
                            </button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-lg btn-danger">
                                @lang('Classes') - <b>{{$totalClasses}}</b>
                            </button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-lg btn-warning">
                                @lang('Sections') - <b>{{$totalSections}}</b>
                            </button>
                        </div>

                    </div>
                    <br>


                    <div class="row" >
                        <div class="col-sm-8">
                            <div class="card  pt-2" style="background-color: rgba(242,245,245,0.8);">
                                <div class="card-body">
                                    <h3>@lang('Welcome to') {{Auth::user()->school->name}}</h3>
                                    @lang ('Your presence and cooperation will help us to improve the education system of our organization.')
                                </div>
                            </div>

                            <div class="card mt-4 border-dark">
                                <h5 class="card-header text-white bg-dark ">@lang('Active Exams')</h5>
                                <div class="card-body">
                                    @if(count($exams) > 0)
                                    <table class="table table-borderless ">
                                        <thead>
                                            <tr>
                                                <th scope="col" >@lang('Exam Name')</th>
                                                <th scope="col" >@lang('Notice Published')</th>
                                                <th scope="col" >@lang('Result Published')</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                        @foreach($exams as $exam)
                                        <tr>
                                            <td>{{$exam->exam_name}}</td>
                                            <td>{{($exam->notice_published === 1)?__('Yes'):__('No')}}</td>
                                            <td>{{($exam->result_published === 1)?__('Yes'):__('No')}}</td>
                                        </tr>
                                        @endforeach
                                        </thead>
                                    </table>
                                    @else
                                    @lang('No Active Examination')
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card mb-3 border-info">
                                <div class="card-header text-white bg-primary">@lang('Notices')</div>
                                <div class="card-body pre-scrollable ">
                                    @if(count($notices) > 0)
                                    <div class="list-group list-group-flush">
                                        @foreach($notices as $notice)
                                        <a href="{{url($notice->file_path)}}" class="list-group-item  list-group-item-action flex-column align-items-start" download>

                                            <div class="d-flex w-100 justify-content-between border-0">
                                                <h5 class="list-group-item-heading">{{$notice->title}}</h5>
                                                <i class="badge badge-download material-icons">
                                                    get_app
                                                </i>
                                            </div>
                                            <small class="mb-1">@lang('Published at'):
                                                {{$notice->created_at->format('M d Y h:i:sa')}}</small>
                                        </a>
                                        @endforeach
                                    </div>
                                    @else
                                    @lang('No New Notice')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="row">
                        <div class="col-sm-4">
                            <div class="card mt-4 border-warning">
                                <div class="card-header text-white bg-warning ">@lang('Events')</div>
                                <div class="card-body pre-scrollable ">
                                @if(count($events) > 0)
                                    <div class="list-group list-group-flush">
                                        @foreach($events as $event)
                                        <a href="{{url($event->file_path)}}" class="list-group-item  list-group-item-action flex-column align-items-start" download>

                                            <div class="d-flex w-100 justify-content-between border-0">

                                                <h5 class="list-group-item-heading">{{$event->title}}</h5>
                                                <i class="badge badge-download material-icons">
                                                    get_app
                                                </i>
                                            </div>
                                            <p class="list-group-item-text">@lang('Published at'):
                                                {{$event->created_at->format('M d Y')}}</p>
                                        </a>
                                        @endforeach
                                    </div>
                                    @else
                                    @lang('No New Event')
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card mt-4 border-danger">
                                <div class="card-header text-white bg-danger ">@lang('Routines')</div>
                                <div class="card-body pre-scrollable">
                                    @if(count($routines) > 0)
                                    <div class="list-group list-group-flush">
                                        @foreach($routines as $routine)
                                        <a href="{{url($routine->file_path)}}" class="list-group-item list-group-item-action flex-column align-items-start" download>
                                            <div class="d-flex w-100 justify-content-between border-0">

                                                <h5 class="list-group-item-heading">{{$routine->title}}</h5>
                                                <i class="badge badge-download material-icons">
                                                    get_app
                                                </i>
                                            </div>
                                            <p class="list-group-item-text">@lang('Published at'):
                                                {{$routine->created_at->format('M d Y')}}</p>
                                        </a>
                                        @endforeach
                                    </div>
                                    @else
                                    @lang('No New Routine')
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card mt-4 border-info">
                                <div class="card-header text-white bg-info ">@lang('Syllabus')</div>

                                <div class="card-body pre-scrollable">
                                    @if(count($syllabuses) > 0)
                                    <div class="list-group list-group-flush">
                                        @foreach($syllabuses as $syllabus)
                                        <a href="{{url($syllabus->file_path)}}" class="list-group-item" download>
                                            <div class="d-flex w-100 justify-content-between border-0">
                                                <h5 class="list-group-item-heading">{{$syllabus->title}}</h5>
                                                <i class="badge badge-download material-icons">
                                                    get_app
                                                </i>
                                            </div>
                                            <p class="list-group-item-text">@lang('Published at'):
                                                {{$syllabus->created_at->format('M d Y')}}</p>
                                        </a>
                                        @endforeach
                                    </div>
                                    @else
                                    @lang('No New Syllabus')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/chart.js')}}"></script>
    <script>
        var ctxDoughnut = document.getElementById('doughnut').getContext('2d');
        var doughnut = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {

                datasets: [{
                    label: '# of Votes',
                    data: [{{$totalStudents - $studentsFullDay}}, {{$studentsFullDay }}, {{$studentsHalfDay}}],
                    backgroundColor: [

                        'rgb(79,227,192)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',


                    ],
                    borderColor: [

                        'rgb(79,227,192)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',

                    ],
                    borderWidth: 2,

                }]
            },
            options:{
                tooltips:{
                    enabled:false
                },
                cutoutPercentage:90

            }
        });

    </script>
</div>
@endsection
