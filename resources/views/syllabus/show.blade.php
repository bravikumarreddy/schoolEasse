@extends('layouts.app')

@section('title', __('Syllabus'))

@section('content')
    <script>
        var csrf_token = '<?php echo csrf_token(); ?>';
    </script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <br>

                <div class="card border-messenger mt-4">
                    <div class="card-header text-white bg-messenger"> Syllabus Status</div>
                    <div class="card-body">

                        <ul class=" mt-3 list-group  mb-4">

                            @foreach( $syllabuses as $syllabus)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span> <b class="text-messenger">Topic :  &nbsp;&nbsp;</b> <span> {{$syllabus->topic}}</span></span>
                                    </div>
                                    <div class=" pt-3 d-flex justify-content-between align-items-center">
                                        <span> <b class="text-messenger">Reference :  &nbsp;&nbsp;</b> <span> {{$syllabus->reference}}</span></span>
                                    </div>

                                    <div class=" pt-3 d-flex justify-content-between align-items-center">
                                        <span> <b class="text-messenger">Comments :  &nbsp;&nbsp;</b> <span> {{$syllabus->comments}}</span></span>
                                    </div>
                                    <div class=" pt-3 d-flex justify-content-between align-items-center">

                                    @if($syllabus->status==1)
                                            <span> <b class="text-messenger">Status :  &nbsp;&nbsp;</b> <span class="badge badge-pill badge-orange" > On-Going </span></span>

                                        @elseif($syllabus->status==2)
                                            <span> <b class="text-messenger">Status :  &nbsp;&nbsp;</b> <span class="badge badge-pill badge-success" > Completed </span></span>

                                        @else
                                            <span> <b class="text-messenger">Status :  &nbsp;&nbsp;</b> <span class="badge badge-pill badge-danger" > Not-started </span></span>

                                        @endif
                                    </div>

                                    @if(Auth::user()->role == 'teacher')
                                        <form method="post" action="/syllabus_status/create">
                                            @csrf
                                            <input type="hidden" name="teacherSubjectId" value="{{$teacherSubjectId}}">
                                            <input type="hidden" name="syllabusId" value="{{$syllabus->syllabus_id}}">
                                            <input type="hidden" name="syllabusStatusId" value="{{$syllabus->syllabus_status_id}}">

                                            <div class=" pt-3 d-flex justify-content-between align-items-center">
                                                <select class="custom-select" name="status" id="inputGroupSelect04" aria-label="Example select with button addon" required>
                                                    <option selected value="">Choose status</option>
                                                    <option value="0">Not-started</option>
                                                    <option value="1">On-Going</option>
                                                    <option value="2">Completed</option>
                                                </select>
                                            </div>
                                            <div class=" pt-3 d-flex justify-content-between align-items-center">
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    >Submit</button>
                                            </div>
                                        </form>

                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>

    </div>



@endsection
