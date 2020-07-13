@extends('layouts.app')

@section('title', __('Teacher Attendance'))

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

                <div id="multiple" role="{{$role ?? null}}" >

                </div>


            </div>
        </div>
    </div>


    </div>



@endsection
