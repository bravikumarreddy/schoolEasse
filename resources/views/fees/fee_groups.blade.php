@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')
    <script>
        var csrf_token = '<?php echo csrf_token(); ?>';
    </script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg" id="main-container">
                <br>

                <div id="fee_groups"  fee_groups="{{$fee_groups}}">

                </div>


            </div>
        </div>
    </div>
    <script src="{{asset('js/fee_groups.js')}}"></script>
    <script>
        var myTable = $('.table-data-div').DataTable({ paging: false });
    </script>
    </div>



@endsection
