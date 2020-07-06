
@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">


                <h4 class="mt-3">My Calendar</h4>
                <div class="row">
                    <div class="col-md-4 m-5">
                        <table class="table table-bordered">
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

                    <div class="col-md-5 m-3" id="calendar">

                    </div>
                </div>




            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
                plugins: [ dayGridPlugin ,bootstrapPlugin],
                dayMaxEvents: 1, // for all non-TimeGrid views

                events: [
                    @foreach($absent_details as $absent)
                    {
                        title: "Absent {{$absent->session}}" ,
                        start:"{{Carbon\Carbon::parse($absent->date)->format("Y-m-d")}}",
                        color: '#E74B3C'
                    },

                    @endforeach
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
