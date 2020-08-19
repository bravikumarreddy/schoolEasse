@extends('layouts.app')

@section('title', __('Messages'))
@section('content')
    <style>
        /*!
         * bootstrap-notifications v1.0.3 (https://skywalkapps.github.io/bootstrap-notifications)
         * Copyright 2017 Martin Staněk
         * Licensed under MIT
         */  .notifications{list-style:none;padding:0}.notification{display:block;padding:9.6px 12px;border-width:0 0 1px 0;border-style:solid;border-color:#eeeeee;background-color:#fff;color:#333333;text-decoration:none}.notification:last-child{border-bottom:0}.notification:hover,.notification.active:hover{background-color:#f9f9f9;border-color:#eeeeee}.notification.active{background-color:#f4f4f4}a.notification:hover{text-decoration:none}.notification-title{font-size:15px;margin-bottom:0}.notification-desc{margin-bottom:0}.notification-meta{color:#777777}.notification-icon{margin-right:6.8775px}.notification-icon:after{position:absolute;content:attr(data-count);margin-left:-6.8775px;margin-top:-6.8775px;padding:0 4px;min-width:13.755px;height:13.755px;line-height:13.755px;background:red;border-radius:10px;color:#fff;text-align:center;vertical-align:middle;font-size:11.004px;font-weight:600;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif}.notification .media-body{padding-top:5.6px}.btn-lg .notification-icon:after{margin-left:-8.253px;margin-top:-8.253px;min-width:16.506px;height:16.506px;line-height:16.506px;font-size:13.755px}.btn-xs .notification-icon:after{content:'';margin-left:-4.1265px;margin-top:-2.06325px;min-width:6.25227273px;height:6.25227273px;line-height:6.25227273px;padding:0}.btn-xs .notification-icon{margin-right:3.43875px}
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-lg" id="main-container">
                <div class="panel panel-default">
                    <div class="page-panel-title">@lang('Messages')</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(count($messages) > 0)
                            <ul class="list-unstyled">
                                @foreach ($messages as $message)
                                    <li class="notification p-3">
                                        <span class=""> From : {{$message->name}} &nbsp; &nbsp; </span> <span class="badge badge-orange">   {{$message->role}} </span>
                                        <br/>
                                        <br/>
                                        <div class="media">

                                            <img class="mr-3" src="{{$message->pic_path}}" alt="Profile_pic"
                                                 style="vertical-align: middle;border-style: none;border-radius: 50%;width: 40px;height: 40px;"
                                            >
                                            <div class="media-body">
                                                <small class="timestamp float-right">{{$message->created_at}}</small>
                                                <h5 class="mt-0">{{$message->title}}</h5>
                                                @if($message->read ==0)
                                                    <button class="btn btn-xs btn-outline-info mark float-right" key="{{$message->message_id}}"><small>mark as
                                                            read</small></button>
                                                @endif
                                                {{$message->message}}

                                            </div>



                                        </div>

                                    </li>
                                @endforeach
                            </ul>
                            {{$messages->links()}}
                        @else
                            @lang('No message found')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(".mark").click(function () {
                let v = $(this).attr('key');
                $.get("/api/message/mark_read/"+v, function(data, status){
                    console.log("Data: " + data + "\nStatus: " + status);

                });
                $(this).fadeOut('slow');

            });

        </script>
    </div>
@endsection
