
@extends('layouts.app')

@if(count(array($user)) > 0)
    @section('title', $user->name)
@endif

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    @if(count(array($user)) > 0)
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-md-10" id="main-container">
                                    <h3>{{$user->name}}  <span class="label label-danger">{{ucfirst($user->role)}}</span> <span class="label label-primary">{{ucfirst($user->gender)}}</span>

                                    </h3>
                                    <div class="table-responsive" style="margin-top: 3%;">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                            <tr>
                                                @if($user->role == "student")
                                                    <td><b>@lang('Code'):</b></td>
                                                    <td>{{$user->student_code}}</td>
                                                    <td><b>@lang('Session'):</b></td>
                                                    <td>@isset($user->studentInfo['session']){{$user->studentInfo['session']}}@endisset</td>
                                                @else
                                                    <td><b>@lang('Code'):</b></td>
                                                    <td>{{$user->student_code}}</td>
                                                    <td><b>@lang('About'):</b></td>
                                                    <td>{{$user->about}}</td>
                                                @endif
                                            </tr>
                                            @if($user->role == "student")
                                                <tr>
                                                    <td><b>@lang('Class'):</b></td>
                                                    <td>{{$user->section->class->class_number}}</td>
                                                    <td><b>@lang('Section'):</b></td>
                                                    <td>{{$user->section->section_number}}</td>
                                                </tr>

                                                <tr>
                                                    <td><b>@lang('Group'):</b></td>
                                                    <td>@isset($user->studentInfo['group']){{$user->studentInfo['group']}}@endisset</td>
                                                    <td><b>@lang('Birthday'):</b></td>
                                                    <td>{{Carbon\Carbon::parse($user->birthday)->format('d/m/Y')}}</td>
                                                </tr>

                                                <tr>
                                                    <td><b>@lang('Father Name'):</b></td>
                                                    <td>@isset($user->studentInfo['father_name']){{$user->studentInfo['father_name']}}@endisset</td>
                                                    <td><b>@lang('Mother Name'):</b></td>
                                                    <td>@isset($user->studentInfo['mother_name']){{$user->studentInfo['mother_name']}}@endisset</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td><b>@lang('Address'):</b></td>
                                                <td>{{$user->address}}</td>
                                                <td><b>@lang('Phone Number'):</b></td>
                                                <td>{{$user->phone_number}}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="panel-body">
                            @lang('No Related Data Found.')
                        </div>
                    @endif
                </div>



                <div class="panel panel-default">
                    <div class="panel-heading">Payment List</div>
                    <div class="panel-body">

                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Fee Structure Name</th>
                                <th>Instalment Number</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Amount </th>
                                <th></th>
                                <th></th>


                            </tr>
                            </thead>
                            <tbody>

                            @foreach($fee_list as $instalment)
                                <tr>
                                    <td>{{$instalment->name}}</td>
                                    <td>{{"Installment ".($instalment->number+1)}}</td>
                                    <td>
                                        @if($instalment->paid)

                                            <span class="label label-info">paid</span>

                                        @else
                                            <span class="label label-danger">unpaid</span>
                                        @endif</td>
                                    <td>{{$instalment->due_date}}</td>
                                    <td>{{$instalment->amount}}</td>
                                    <td>
                                        @if($instalment->paid==0)
                                            <form id="form-id" method="post" action="">
                                                <input type="hidden" name="student_instalment_id" value="{{$instalment->student_instalment_id}}">
                                                <input type="hidden" name="student_id" value="{{$user->id}}">
                                                @csrf
                                                <button class="btn-xs btn-success" disabled>
                                                    <small>Pay</small>
                                                </button>
                                            </form>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-warning">
                    <div class="panel-heading">Transactions</div>
                    <div class="panel-body">
                        <br>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
