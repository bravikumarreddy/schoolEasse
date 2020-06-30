@extends('layouts.app')
@section('title', __('All Active Examinations'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="card  border-0 ">


                <div class="card-body">
                    <h4 class="card-title">@lang('All Active Examinations')</h4>
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                    @if(count($exams) > 0)
                        @foreach($exams as $exam)
                            @component('components.active-exams',['exam'=>$exam,'courses'=>$courses])
                            @endcomponent

                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
