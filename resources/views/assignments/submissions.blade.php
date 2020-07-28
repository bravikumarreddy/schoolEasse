@extends('layouts.app')

@section('title', __('Staff Attendance'))

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>




            <div class="col-md-10" id="main-container">



                @if (session('error'))
                    <div class="alert mt-3 alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card  mt-4 overflow-hidden border-0">
                    <div class="card-header text-white bg-brown"><h5 class="mb-0" > Assignment Submissions </h5> </div>

                    <div class="card-body">
                        @foreach($assignments as $assignment)
                            <li class="media shadow-sm mb-3 mt-3 pb-3 p-3 ">
                                <img class="mr-3 align-self-start" src="{{$assignment->pic_path}}" alt="Profile_pic"
                                     style="vertical-align: middle;border-style: none;border-radius: 50%;width: 40px;height: 40px;"
                                >
                                <div class="media-body">
                                    <small class="timestamp float-right"><b>Submitted at - </b>{{$assignment->submitted_at}}</small>
                                    <h5 class=""> {{$assignment->name}} </h5>
                                    <h5 class="mt-4"> <b> Description - </b>{{$assignment->description}} </h5>

                                    @if($assignment->url_path)
                                        <div class="input-group mt-3">

                                                <a class=" btn p-2 bg-success text-white" download
                                                   href="{{ url($assignment->url_path) }}"><i class="material-icons">cloud_download</i>
                                                    <span class="nav-link-text p-2">Download File Attachment</span>
                                                </a>

                                        </div>
                                    @endif

                                </div>
                            </li>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>

    </script>

    </div>



@endsection
