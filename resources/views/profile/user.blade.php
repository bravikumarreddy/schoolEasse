@extends('layouts.app')

@if(count(array($user)) > 0)
  @section('title', $user->name)
@endif

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg" id="main-container">
            <div class="panel panel-default">
              @if(count(array($user)) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.user-profile',['user'=>$user])
                    @endcomponent
                </div>
              @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
