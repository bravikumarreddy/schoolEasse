@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg" id="main-container">
                <br>

                <h4>Collect Fees</h4>


                <div id="example" classes="{{$classes}}">

                </div>



            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script>

    </script>
    </div>



@endsection
