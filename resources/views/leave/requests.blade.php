@extends('layouts.app')

@section('title', __('Leave Requests'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>

            <div class="col-md-10" id="main-container">

                <div class="mt-4">
                    <h4>Leave requests </h4>

                    <ul class=" mt-3 list-group mb-4 ">
                        @foreach( $leaves as $leave)

                            <li class="list-group-item ">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span> <b class="text-messenger" >Name : &nbsp;&nbsp;</b> {{$leave->name}} </span>
                                </div>

                                <div class="d-flex pt-3 justify-content-between align-items-center">
                                    <span> <b class="text-messenger" >Email : &nbsp;&nbsp;</b> {{$leave->email}} </span>
                                </div>
                                <div class="d-flex pt-3 justify-content-between align-items-center">
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

                                @if($leave->status == 'applied' )

                                    <form method="post" action=
                                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                        {{"/leave/approve-request" }}
                                        @else
                                        {{"/leave/teacher/approve-request" }}
                                        @endif

                                    >
                                        @csrf
                                        <input type="hidden" name="request_id" value="{{$leave->id}}">
                                        <div class="form-group pt-3">
                                            <label for="description" class="text-messenger"><b>Comment :</b></label>
                                            <textarea type="text" class="form-control" name="comment" id="description" required></textarea>
                                        </div>
                                        <div class="form-group pt-2">
                                            <label for="description" class="text-messenger"><b>Approve / Reject :</b></label>
                                            <select class="form-control" name="status">
                                                <option value="approved" >Approve</option>
                                                <option value="rejected" >Reject</option>
                                            </select>

                                        </div>
                                        <div class="form-group pt-2">
                                            <div class="col-sm-8 pl-0">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                                @isset($leave->approved_by)
                                    <div class=" pt-3 d-flex justify-content-between align-items-center">
                                            <span> <b class="text-messenger">Approved by :  &nbsp;&nbsp;</b> <span>{{$leave->approved_by}}</span></span>
                                    </div>

                                    <div class=" pt-3 d-flex justify-content-between align-items-center">
                                        <span> <b class="text-messenger" >Comment :  &nbsp;&nbsp;</b> <span>{{$leave->comment}}</span></span>
                                    </div>

                                @endisset



                            </li>

                        @endforeach

                    </ul>
                    {{$leaves->links()}}
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
