@extends('layouts.app')

@section('title', __('Apply Leave'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>

            <div class="col-md-10" id="main-container">


                    <div class="card  mt-4 overflow-hidden border-yellow ">
                        <div class="card-header text-white bg-yellow"><h5 class="mb-0" > Leave Requests </h5> </div>

                        <div class="card-body">


                            <form method="post" autocomplete="off" action=

                            @if(Auth::user()->role == 'teacher')
                                {{"/leave/teacher/create" }}
                            @else
                                    {{"/leave/student/create" }}
                            @endif >
                                @csrf

                                <div class="form-group">
                                    <label for="title">From</label>
                                    <input type="text" name="from" autocomplete="off" class="form-control datepicker" id="title" placeholder="" required>
                                </div>

                                <div class="form-group">
                                    <label for="title">To</label>
                                    <input type="text" name="to" autocomplete="off"  class="form-control datepicker" id="title" placeholder="" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Reason</label>
                                    <textarea type="text" class="form-control" name="reason" id="description" required></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8 pl-0">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>


                    </div>
                <div class="mt-4">
                    <h4> My Leave requests </h4>

                    <ul class=" mt-3 list-group  mb-4">
                        @foreach( $my_leaves as $leave)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <span> <b class="text-messenger" >Date : &nbsp;&nbsp;</b> {{$leave->from}} &nbsp;<b class="text-success"> to </b> &nbsp; {{$leave->to}} </span>
                            </div>
                            <div class=" pt-3 d-flex justify-content-between align-items-center">
                                <span> <b class="text-messenger" >Status :  &nbsp;&nbsp;</b>

                                    @if($leave->status == 'applied' )
                                        <span class="badge badge-indigo badge-pill">Appllied</span>
                                        @elseif($leave->status == 'approved')
                                        <span class="badge badge-success badge-pill">Approved</span>
                                        @elseif($leave->status == 'rejected')
                                        <span class="badge badge-danger badge-pill">Rejected</span>
                                        @endif



                                </span>

                            </div>
                            <div class=" pt-3 d-flex justify-content-between align-items-center">
                                <span> <b class="text-messenger" >Reason :  &nbsp;&nbsp;</b> <span> {{$leave->reason}}</span></span>
                            </div>

                            @isset($leave->approved_by)
                                <div class=" pt-3 d-flex justify-content-between align-items-center">
                                    <span> <b
                                            class="text-messenger">Approved by :  &nbsp;&nbsp;</b> <span>{{$leave->approved_by}}</span></span>
                                </div>

                                <div class=" pt-3 d-flex justify-content-between align-items-center">
                                    <span> <b class="text-messenger" >Comment :  &nbsp;&nbsp;</b> <span>{{$leave->comment}}</span></span>
                                </div>
                            @endisset



                        </li>

                        @endforeach

                    </ul>
                </div>
            </div>

        </div>
        <script>
            $('.datepicker').datepicker({
                format: 'dd-mm-yy',

                autoclose:true,
            });
        </script>
    </div>
@endsection
