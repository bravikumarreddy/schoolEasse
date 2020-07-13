@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')
    <script>
        var csrf_token = '<?php echo csrf_token(); ?>';
    </script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <br>

                <h4>Attendance</h4>


                <div id="daily-attendance" classes="{{$classes}}" class="{{$class ?? null}}" section="{{$section ?? null}}"  >

                </div>



            </div>
        </div>
    </div>
    <script src="{{asset('js/daily-attendance.js')}}"></script>
        <script>
            var myTable = $('.table-data-div').DataTable({ paging: false });
        </script>
    </div>



@endsection
