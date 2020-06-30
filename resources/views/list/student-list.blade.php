@extends('layouts.app')

@section('title', __('Students'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="card">
              @if(count($users) > 0)
              @foreach ($users as $user)
                @if (Session::has('section-attendance'))
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="margin-top: 3%;">
                        <li class="breadcrumb-item" ><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('Classes &amp; Sections')</a></li>
                        <li class="breadcrumb-item active">{{ucfirst($user->role)}}s</li>
                    </ol>
                </nav>
                @endif

                 @break($loop->first)
              @endforeach
                <div class="card-body">
                    <h4 class="card-title">@lang('List of all') {{ucfirst($user->role)}}s</h4>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.users-export',['type'=>'student'])
                        
                    @endcomponent
                    @component('components.users-list',['users'=>$users,'current_page'=>$current_page,'per_page'=>$per_page])
                    @endcomponent
                </div>
              @else
                <div class="card-body">
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
