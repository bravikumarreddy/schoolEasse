@extends('layouts.app')

@section('title', __('Course'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>

            <div class="col-md-10" id="main-container">

                <div class="card border-0" >
                    <div class="card-body">
                        <h4 class="card-title"> @lang('Marks and Grades History')</h4>
                        <div class="row">

                        @foreach( $all_exams as $exams)

                            <div class="card border-0 col-6" >
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <h4 class="card-title"> {{$exams->keys()[0]}}</h4>
                                        <thead class="thead bg-orange text-white">
                                        <tr>

                                            <th scope="col">Subject</th>
                                            <th scope="col">Marks</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($exams[$exams->keys()[0]] as $marks)
                                        <tr>

                                                <td>{{$marks->name}} </td>
                                                <td>{{$marks->marks}} /{{$marks->max_marks}}</td>


                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
