@extends('layouts.app')

@section('title', __('Transportation'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>

            <div class="col-md-10" id="main-container">

                @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                    <div class="card  mt-4 overflow-hidden border-yellow ">
                        <div class="card-header text-white bg-yellow"><h5 class="mb-0" > Add Transportation </h5> </div>

                        <div class="card-body">


                        <form method="post" action="/transportation/create"  >
                            @csrf

                            <div class="form-group">
                                <label for="title">Route Name</label>
                                <input type="text" name="name" class="form-control" id="title" placeholder="Route Name" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Vehicle Number</label>
                                <input type="text" class="form-control" name="number" id="description" required >
                            </div>

                            <div class="form-group">
                                <label for="description">Driver Number</label>
                                <input type="number" class="form-control" name="ph_number" id="description" >
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
                    <table class="table mt-4 table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Route</th>
                            <th scope="col">Vehicle Number</th>
                            <th scope="col">Driver Ph Number</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                <th scope="col">Delete Route</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i =0
                        @endphp
                        @foreach( $routes as $route)
                            @php
                                $i += 1
                            @endphp
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$route->name}}</td>
                                <td>{{$route->number}}</td>
                                <td>{{$route->ph_number}}</td>

                                @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                    <td scope="col">
                                        <form method="post" action="/transportation/delete/{{$route->id}}"  >
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
