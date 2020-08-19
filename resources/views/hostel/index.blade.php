@extends('layouts.app')

@section('title', __('Transportation'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg" id="main-container">

                @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                    <div class="card  mt-4 overflow-hidden border-yellow ">
                        <div class="card-header text-white bg-yellow"><h5 class="mb-0" > Add Hostel Room </h5> </div>

                        <div class="card-body">


                            <form method="post" action="/hostel/create"  >
                                @csrf

                                <div class="form-group">
                                    <label for="title">Room Name</label>
                                    <input type="text" name="name" class="form-control" id="title" placeholder="Room Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Room Type</label>
                                    <input type="text" class="form-control" name="room_type" id="description" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Number of beds</label>
                                    <input type="number" class="form-control" name="beds" id="description" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Cost</label>
                                    <input type="number" class="form-control" name="cost" id="description" >
                                </div>




                                <div class="form-group">
                                    <div class="col-sm-8 pl-0">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>

                @endif
                <table class="table mt-4 table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Room Name</th>
                            <th scope="col">Room Type</th>
                            <th scope="col">No.of Beds</th>
                            <th scope="col">Cost</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                <th scope="col">Delete Room</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i =0
                    @endphp
                    @foreach( $rooms as $room)
                        @php
                            $i += 1
                        @endphp
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$room->name}}</td>
                            <td>{{$room->room_type}}</td>
                            <td>{{$room->beds}}</td>
                            <td>
                                &#8377; {{$room->cost}}</td>

                            @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                <td scope="col">
                                    <form method="post" action="/hostel/delete/{{$room->id}}"  >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            @endif

                        </tr>

                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
