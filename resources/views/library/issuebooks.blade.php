@extends('layouts.app')
@section('title', __('Issue Book'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-lg" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('Issue books')</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.book-issue-form',['books'=>$books])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
