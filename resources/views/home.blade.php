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
        <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg" id="main-container">

            <div class="pt-lg-3 card border-0 " >

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                        @if(Auth::user()->role == 'admin')
                            <div class="card border-0 p-0 mb-3 shadow">

                                <div class="card-body p-0 m-0 mb-4">
                                    <div class="card-header pl-0 pr-0 ml-0 mr-0  d-flex bg-messenger row justify-content-between text-white mb-3 border-0">
                                        <h4 class="d-inline-block align-self-center mx-auto text-center pl-3 pr-4 mr-4">
                                            Attendance Overview
                                        </h4>
                                        <div class="d-flex row col-sm  justify-content-around mr-1 pr-1 pl-3 ">
                                            <div class="mr-1">
                                                <h5 class="d-inline "><span class="badge" style="background-color:#4FE3BF">&nbsp;&nbsp;</span></h5>
                                                <span> &nbsp; Preset </span>

                                            </div>
                                            <div class="mr-1 ">
                                                <h5 class="d-inline "><span class="badge" style="background-color:#FFCE56">&nbsp;&nbsp;</span>

                                                </h5>
                                                <span > &nbsp; Half Day </span>

                                            </div>
                                            <div class=" mr-1 ">
                                                <h5 class="d-inline "><span class="badge" style="background-color:#FF6383">&nbsp;&nbsp;</span>

                                                </h5>
                                                <span> &nbsp; Absent </span>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="d-flex row justify-content-around p-2 m-2">
                                        <div class="">
                                            <div  style="width: 150px; height: 150px; position: relative;">
                                                <canvas class="m-auto" id="doughnut" width="100px" height="100px"></canvas>
                                                <div
                                                    style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                                                    <h4 class="m-0"><b>{{$totalStudents - $studentsFullDay -$studentsHalfDay}}</b></h4>
                                                    <small>Students present </small><br/>
                                                    <small>out of {{$totalStudents}}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div  style="width: 150px; height: 150px; float: left; position: relative;">
                                                <canvas id="doughnut_teachers" width="100px" height="100px"></canvas>
                                                <div
                                                    style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                                                    <h4 class="m-0"><b>{{$totalTeachers - $teachersFullDay -$teachersHalfDay}}</b></h4>
                                                    <small>Teachers present</small><br/>
                                                    <small>out of {{$totalTeachers}}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="" >
                                            <div  style="width: 150px; height: 150px; float: left; position: relative;">
                                                <canvas id="doughnut_staff" width="100px" height="100px"></canvas>
                                                <div
                                                    style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                                                    <h4 class="m-0"><b>{{$totalStaff - $staffFullDay -$staffHalfDay}}</b></h4>
                                                    <small>Staff present</small><br/>
                                                    <small>out of {{$totalStaff}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                
                            </div>


                        @endif
{{--                    <div class="row ">--}}

{{--                        <div class="col-sm-2">--}}
{{--                            <button type="button" class="btn btn-lg btn-primary" >--}}
{{--                                @lang('Students') - <b>{{$totalStudents}}</b>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-2">--}}
{{--                            <button type="button" class="btn btn-lg btn-success" >--}}
{{--                                @lang('Teachers') - <b>{{$totalTeachers}}</b>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-3">--}}
{{--                            <button type="button" class="btn btn-lg btn-info">--}}
{{--                                @lang('Types of Books In Library') - <b>{{$totalBooks}}</b>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-2">--}}
{{--                            <button type="button" class="btn btn-lg btn-danger">--}}
{{--                                @lang('Classes') - <b>{{$totalClasses}}</b>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-2">--}}
{{--                            <button type="button" class="btn btn-lg btn-warning">--}}
{{--                                @lang('Sections') - <b>{{$totalSections}}</b>--}}
{{--                            </button>--}}
{{--                        </div>--}}

{{--                    </div>--}}


                    <div class="row" >
                        <div class="col-xl-8 col-lg-6 col-md-6">
                            <div class="card shadow" style="background-color: rgb(255,255,255);">
                                <div class="card-header text-white bg-yellow"><h4 class="mb-0" > Welcome to {{Auth::user()->school->name}}</h4> </div>
                                <div class="card-body text-dark">

                                    <li class="media">
                                        <img class="mr-3 align-self-center"
                                             style="vertical-align: middle;border-style: none;border-radius: 50%;width: 60px;height: 60px;"

                                             src="https://toppersunited.com/wp-content/uploads/2018/12/delhi-international-school-logo.jpg" alt="Generic placeholder image">
                                        <div class="media-body">

                                            <h5>{{Auth::user()->school()->first()->about}}</h5>
                                        </div>
                                    </li>
                                </div>
                            </div>


                            <div class="card shadow-lg mt-4 overflow-hidden mb-3">
                                <div class="card-body p-0 m-0 ">
                                    <div id="carouselExampleControls" class="carousel slide overflow-hidden"  style="" data-ride="carousel">
                                        <div class="carousel-inner" >
                                            @if($image1 != null)
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{$image1->url_path}}" alt="First slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h2 ><b>{{$image1->title}} </b></h2>
                                                        <h3> {{$image1->description}} </h3>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="https://www.dell.org/wp-content/uploads/2020/04/indian-school-children-social-impact.jpeg" alt="First slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h2 ><b>Board Examinations </b></h2>
                                                        <h3> All the best for 10th Class Students </h3>
                                                    </div>
                                                </div>
                                            @endif

                                                @if($image2 != null)
                                                    <div class="carousel-item ">
                                                        <img class="d-block w-100" src="{{$image2->url_path}}"  alt="Second slide">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h2 ><b>{{$image2->title}} </b></h2>
                                                            <h3> {{$image2->description}} </h3>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100 h-100" src="https://www.skoltech.ru/app/data/uploads/2019/12/DSC04232.jpg" alt="Third slide">
                                                        <div class="carousel-caption d-none d-md-block">

                                                            <h3> Sirius Hosts a Russian-Indian Project School </h3>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($image3 != null)
                                                    <div class="carousel-item ">
                                                        <img class="d-block w-100" src="{{$image3->url_path}}" alt="First slide">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h2 ><b>{{$image3->title}} </b></h2>
                                                            <h3> {{$image3->description}} </h3>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="https://www.desktopbackground.org/download/1600x900/2010/04/30/10145_happy-school-holiday-wallpapers_1920x1200_h.jpg" alt="Third slide">
                                                        <div class="carousel-caption d-none d-md-block ">

                                                            <h3> School reopen on Aug-2 </h3>
                                                        </div>
                                                    </div>
                                                @endif




                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4  col-lg-6  col-md-6 mb-3">
                            <div class="  card mb-3 shadow" style="height: 500px" >
                                <div class="card-header mb-2 text-white bg-orange"><h4 class="m-0"> @lang('School Events')</h4></div>
                                <div class="  card-body  mt-2 pt-0 ">
                                        <div id="calendar"  ></div>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                        <div class="row">--}}
{{--                        <div class="col-sm-4">--}}
{{--                            <div class="card mt-4 border-warning shadow">--}}
{{--                                <div class="card-header text-white bg-warning ">@lang('Events')</div>--}}
{{--                                <div class="card-body pre-scrollable ">--}}
{{--                                @if(count($events) > 0)--}}
{{--                                    <div class="list-group list-group-flush">--}}
{{--                                        @foreach($events as $event)--}}
{{--                                        <a href="{{url($event->file_path)}}" class="list-group-item  list-group-item-action flex-column align-items-start" download>--}}

{{--                                            <div class="d-flex w-100 justify-content-between border-0">--}}

{{--                                                <h5 class="list-group-item-heading">{{$event->title}}</h5>--}}
{{--                                                <i class="badge badge-download material-icons">--}}
{{--                                                    get_app--}}
{{--                                                </i>--}}
{{--                                            </div>--}}
{{--                                            <p class="list-group-item-text">@lang('Published at'):--}}
{{--                                                {{$event->created_at->format('M d Y')}}</p>--}}
{{--                                        </a>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                    @else--}}
{{--                                    @lang('No New Event')--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-sm-4">--}}
{{--                            <div class="card mt-4 border-danger shadow">--}}
{{--                                <div class="card-header text-white bg-danger ">@lang('Routines')</div>--}}
{{--                                <div class="card-body pre-scrollable">--}}
{{--                                    @if(count($routines) > 0)--}}
{{--                                    <div class="list-group list-group-flush">--}}
{{--                                        @foreach($routines as $routine)--}}
{{--                                        <a href="{{url($routine->file_path)}}" class="list-group-item list-group-item-action flex-column align-items-start" download>--}}
{{--                                            <div class="d-flex w-100 justify-content-between border-0">--}}

{{--                                                <h5 class="list-group-item-heading">{{$routine->title}}</h5>--}}
{{--                                                <i class="badge badge-download material-icons">--}}
{{--                                                    get_app--}}
{{--                                                </i>--}}
{{--                                            </div>--}}
{{--                                            <p class="list-group-item-text">@lang('Published at'):--}}
{{--                                                {{$routine->created_at->format('M d Y')}}</p>--}}
{{--                                        </a>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                    @else--}}
{{--                                    @lang('No New Routine')--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                            <div class="card mt-4 border-info shadow">--}}
{{--                                <div class="card-header text-white bg-info ">@lang('Syllabus')</div>--}}

{{--                                <div class="card-body pre-scrollable">--}}
{{--                                    @if(count($syllabuses) > 0)--}}
{{--                                    <div class="list-group list-group-flush">--}}
{{--                                        @foreach($syllabuses as $syllabus)--}}
{{--                                        <a href="{{url($syllabus->file_path)}}" class="list-group-item" download>--}}
{{--                                            <div class="d-flex w-100 justify-content-between border-0">--}}
{{--                                                <h5 class="list-group-item-heading">{{$syllabus->title}}</h5>--}}
{{--                                                <i class="badge badge-download material-icons">--}}
{{--                                                    get_app--}}
{{--                                                </i>--}}
{{--                                            </div>--}}
{{--                                            <p class="list-group-item-text">@lang('Published at'):--}}
{{--                                                {{$syllabus->created_at->format('M d Y')}}</p>--}}
{{--                                        </a>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                    @else--}}
{{--                                    @lang('No New Syllabus')--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/chart.js')}}"></script>

    <script>
        window.addEventListener('load',(event)=>{


            @if(Auth::user()->role == 'admin')
        var ctxDoughnut = document.getElementById('doughnut').getContext('2d');
        var doughnut = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {

                datasets: [{
                    label: '# of Votes',
                    data: [{{$totalStudents - $studentsFullDay-$studentsHalfDay}}, {{$studentsFullDay }}, {{$studentsHalfDay}}],
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

        let ctxDoughnutTeachers = document.getElementById('doughnut_teachers').getContext('2d');
        let doughnut_teachers = new Chart(ctxDoughnutTeachers, {
            type: 'doughnut',
            data: {

                datasets: [{
                    label: '# of Votes',
                    data: [{{$totalTeachers - $teachersFullDay-$teachersHalfDay}}, {{$teachersFullDay }}, {{$teachersHalfDay}}],
                    backgroundColor: [

                        'rgb(79,227,192)',
                        'rgb(255,99,132)',
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



        let ctxDoughnutStaff = document.getElementById('doughnut_staff').getContext('2d');
        let doughnut_staff = new Chart(ctxDoughnutStaff, {
            type: 'doughnut',
            data: {

                datasets: [{
                    label: '# of Votes',
                    data: [{{$totalStaff - $staffFullDay-$staffHalfDay}}, {{$staffFullDay }}, {{$staffHalfDay}}],
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
        @endif

        var calendarEl = document.getElementById('calendar');

        var calendar = new Calendar(calendarEl, {
            plugins: [ dayGridPlugin ,listPlugin,bootstrapPlugin ],
            handleWindowResize: true,
            height:"100%",

            initialView:'listMonth',
            headerToolbar: { left: 'prev,next today',
                center: 'title',
                right: ''
            },
            dayMaxEvents: 1, // for all non-TimeGrid views
            titleFormat:{
                month: 'long',

            },
            events: [

                    @isset($absent_details)
                    @foreach($absent_details as $absent)
                        {
                            title: "Absent {{$absent->session}}" ,
                            start:"{{Carbon\Carbon::parse($absent->date)->format("Y-m-d")}}",
                            color: '#E74B3C'
                        },

                    @endforeach
                    @endisset


                    @isset($teacher_events)
                    @foreach($teacher_events as $event)
                {
                    title: "{{$event->title}}" ,
                    start:"{{$event->from}}",
                    end:"{{$event->to}}",
                    color: '{{$event->color}}'
                },

                    @endforeach
                    @endisset

                    @isset($student_events)
                    @foreach($student_events as $event)
                {
                    title: "{{$event->title}}" ,
                    start:"{{$event->from}}",
                    end:"{{$event->to}}",
                    color: '{{$event->color}}'
                },

                    @endforeach
                    @endisset


                    @isset($individual_events)
                    @foreach($individual_events as $event)
                {
                    title: "{{$event->title}}" ,
                    start:"{{$event->from}}",
                    end:"{{$event->to}}",
                    color: '{{$event->color}}'
                },

                    @endforeach
                    @endisset

                    @isset($section_events)
                    @foreach($section_events as $event)
                {
                    title: "{{$event->title}}" ,
                    start:"{{$event->from}}",
                    end:"{{$event->to}}",
                    color: '{{$event->color}}'
                },

                    @endforeach
                    @endisset

                    @isset($staff_events)
                    @foreach($staff_events as $event)
                {
                    title: "{{$event->title}}" ,
                    start:"{{$event->from}}",
                    end:"{{$event->to}}",
                    color: '{{$event->color}}'
                },

                    @endforeach
                    @endisset

                    @isset($all_events)
                    @foreach($all_events as $event)
                {
                    title: "{{$event->title}}" ,
                    start:"{{$event->from}}",
                    end:"{{$event->to}}",
                    color: '{{$event->color}}'
                },

                    @endforeach
                    @endisset


                { // this object will be "parsed" into an Event Object
                    title: 'The Title', // a property!
                    start: '2020-06-06', // a property!
                    end: '2020-06-06' // a property! ** see important note below about 'end' **
                }

            ],


        });

        calendar.render();
        });
    </script>
</div>
@endsection
