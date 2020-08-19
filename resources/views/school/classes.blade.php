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

            <div id="multiple">

            </div>


        </div>
    </div>
</div>


</div>



@endsection
