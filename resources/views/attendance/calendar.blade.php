
@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">


                    <div class="card  col-12 border-0 ">
                        <h4 class="card-header">My Events</h4>
                        <div class="card-body">
                            <div class="row justify-content-start">
                            <div class="col-6" id="calendar"> </div>
                            <div class="col-2 mt-auto mb-auto">

                                    <table class="table  table-bordered">
                                        <thead>
                                        <tr>

                                            <th scope="col">Absent days</th>

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
                    <div class="card  col-12 border-0 ">
                        <h4 class="card-header">My Time-Table</h4>
                        <div class="card-body">
                            <div class="row ">
                                <div  class="col-6" id="timeTable"></div>
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
                headerToolbar: { left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },
                dayMaxEvents: 1, // for all non-TimeGrid views
                titleFormat:{
                    month: 'short',
                    year: '2-digit',
                },
                events: [
                    @foreach($absent_details as $absent)
                    {
                        title: "Absent {{$absent->session}}" ,
                        start:"{{Carbon\Carbon::parse($absent->date)->format("Y-m-d")}}",
                        color: '#E74B3C'
                    },

                    @endforeach
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
