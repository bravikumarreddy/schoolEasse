
@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg mr-3" id="main-container">


                    <div class="card p-0 col-12 border-1 border-messenger m-3 ">
                        <h4 class="card-header bg-messenger text-white">My Events</h4>
                        <div class="card-body">
                            <div class="row justify-content-center">
                            <div class="col-xl-7 col-lg-9 col-md-10 col-sm-12" id="calendar"> </div>
                            <div class="col-10  mt-3 ">

                                    <table class="table  table-bordered">
                                        <thead>
                                        <tr>

                                            <th class="bg-dark text-white" scope="col">Absent days</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>

                                            <td>{{count($absent_details)}}</td>

                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                </div>

                @if(isset($classTimeTable) || isset($teacherTimeTable))
                    <div class="card p-0 col-12 border-1 border-orange m-3 ">
                        <h4 class="card-header bg-orange text-white">My Time-Table</h4>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div  class="col-xl-7 col-lg-9 col-md-10 col-sm-12" id="timeTable"></div>
                            </div>
                        </div>
                    </div>
                @endisset




            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
                plugins: [ dayGridPlugin ,listPlugin,bootstrapPlugin ],
                handleWindowResize: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right:""

                },
                footerToolbar:{

                    center: 'dayGridMonth,listMonth'

                },
                dayMaxEvents: 1, // for all non-TimeGrid views
                titleFormat:{
                    month: 'short',
                    year: '2-digit',
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

                        @isset($absent_events)
                        @foreach($absent_events as $event)
                    {
                        title: "{{$event->title}}" ,
                        start:"{{Carbon\Carbon::parse($event->from)->format("Y-m-d")}}",
                        end:"{{Carbon\Carbon::parse($event->to)->format("Y-m-d")}}",
                        color: '{{$event->color}}'
                    },

                        @endforeach


                        @endisset


                        @isset($exam_events)
                        @foreach($exam_events as $event)
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


            @isset($classTimeTable)
                var timeTableEl = document.getElementById('timeTable');

                var timeTable = new Calendar(timeTableEl, {
                    plugins: [  timeGridPlugin,listPlugin,bootstrapPlugin ],
                    initialView: 'timeGridWeek',
                    expandRows:true,
                    scrollTime:'09:00:00',

                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right:""

                    },
                    titleFormat:{
                        month: 'short',
                        year: '2-digit',
                    },
                    footerToolbar:{

                        center: 'timeGridWeek,timeGridDay,listWeek'

                    },
                    events: [
                            @foreach($classTimeTable as $timetable)
                                {
                                    title: "{{$timetable->name}} ({{$timetable.teacher_name}})" ,
                                    daysOfWeek:[{{ $timetable->day_of_the_week }}],
                                    startTime:"{{$timetable->from}}",
                                    endTime:"{{$timetable->to}}",
                                },

                            @endforeach

                    ],


                });

                timeTable.render();
            @endisset

         @isset($teacherTimeTable)
            var timeTableEl = document.getElementById('timeTable');

            var timeTable = new Calendar(timeTableEl, {
                plugins: [  timeGridPlugin,listPlugin,bootstrapPlugin ],
                initialView: 'timeGridWeek',
                expandRows:true,
                scrollTime:'09:00:00',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right:""

                },
                titleFormat:{
                    month: 'short',
                    year: '2-digit',
                },
                footerToolbar:{

                    center: 'timeGridWeek,timeGridDay,listWeek'

                },
                events: [

                    @foreach($teacherTimeTable as $timetable)
                    {
                        title: "C-{{$timetable->class_number}} S-{{$timetable->section_number}} {{$timetable->name}} " ,
                        daysOfWeek:[{{ $timetable->day_of_the_week }}],
                        startTime:"{{$timetable->from}}",
                        endTime:"{{$timetable->to}}",
                    },

                    @endforeach

                ],


            });

            timeTable.render();
            @endisset
     });
    </script>


    </div>



@endsection
