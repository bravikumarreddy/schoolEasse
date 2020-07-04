
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
                <div class="card m-3">
                    @if(count(array($user)) > 0)
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2" align="center">
                                        <div style="height: 70px;"></div>
                                        @if(!empty($user->pic_path))
                                            <img src="{{asset('01-progress.gif')}}" data-src="{{url($user->pic_path)}}" class="img-thumbnail" id="my-profile" alt="Profile Picture" width="100%">
                                        @else
                                            @if(strtolower($user->gender) == trans('male'))
                                                <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/guest-male--v1.png" class="img-thumbnail" width="100%">
                                            @else
                                                <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/businesswoman.png" class="img-thumbnail" width="100%">
                                            @endif
                                        @endif

                                    </div>
                                    <div class="col-md-10" id="main-container">
                                        <h3>{{$user->name}}  <span class="badge badge-danger">{{ucfirst($user->role)}}</span> <span class="badge badge-primary">{{ucfirst($user->gender)}}</span>

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



                <div class="card m-3 ">
                    <h4 class="card-header">Payment List</h4>
                    <div class="card-body ">
                        @if(count($fee_list) >0)
                        <table class="table table-bordered table table-hover ">
                            <thead class="thead-light">
                            <tr>
                                <th>Fee Structure Name</th>
                                <th>Instalment Number</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Amount </th>
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

                                            <span class="badge badge-info">paid</span>

                                        @else
                                            <span class="badge badge-danger">unpaid</span>
                                        @endif</td>
                                    <td>{{$instalment->due_date}}</td>
                                    <td>{{$instalment->amount}}</td>
                                    <td>
                                        @if($instalment->paid==0)
                                            <form id="form-id" method="post" action="/fees/student/collect">
                                                <input type="hidden" name="student_instalment_id" value="{{$instalment->student_instalment_id}}">
                                                <input type="hidden" name="student_id" value="{{$user->id}}">
                                                @csrf
                                                <button class="btn btn-sm btn-success">
                                                    <small>Collect</small>
                                                </button>
                                            </form>
                                        @endif
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                            @endif
                    </div>
                </div>

                <div class="card m-3" >
                    <h4 class="card-header">Add Fees</h4>
                    <div class="card-body">
                        <br>
                        <form id="form-id" method="post" action="/fees/student/add">
                            @csrf
                            <input type="hidden" name="student_id" value="{{$user->id}}">
                        <div class="col-md-4 mb-3">
                            <div class="row">
                                    <div class="col-md-10 mb-3">

                                        <select id="fee_structure"  class="custom-select form-control" name="fee_structure">
                                            <option value="">Select Fee Structure</option>
                                            @foreach($fee_structures as $fee_structure)
                                                <option value="{{$fee_structure->id}}">{{$fee_structure->name}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        @error('add')
                                            <div class="text-danger">
                                                <strong>Already Existis</strong>
                                            </div>
                                        @enderror
                                    </div>
                                <div class="col-md-2 mb-3">

                                    <button class="btn btn-success" type="submit">
                                        <small>Add</small>
                                    </button>
                                </div>
                            </div>
                        </div>






                        </form>
                    </div>
                </div>

                <div class="card m-3">
                    <h4 class="card-header">Delete Fees</h4>
                    <div class="card-body">
                        <br>
                        <form id="form-id" method="post" action="/fees/student/delete">
                            @csrf
                            <input type="hidden" name="student_id" value="{{$user->id}}">
                            <div class="col-md-4 mb-3">
                                <div class="row">
                                    <div class="col-md-10 mb-3">

                                        <select id="fee_structure"  class=" custom-select form-control" name="fee_structure">
                                            <option value="">Select Fee Structure</option>
                                            @foreach($existing_fee_structures as $fee_structure)
                                                <option value="{{$fee_structure->id}}">{{$fee_structure->name}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        @error('delete')

                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-3">

                                        <button class="btn btn-danger" type="submit">
                                            <small>Delete</small>
                                        </button>
                                    </div>
                                </div>
                            </div>






                        </form>
                    </div>
                </div>

                <div class="card m-3">
                    <div class="card-header">Transactions</div>
                    <div class="card-body">
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>

                                <th scope="col">Fee Structure Name</th>
                                <th scope="col">Amount Paid</th>
                                <th scope="col">Installment number</th>
                                <th scope="col">Transaction date</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach($transactions as $transaction)



                                <tr>

                                    <td>{{$transaction->fee_structure}}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{$transaction->Instalment_number +1}}</td>
                                    <td>{{$transaction->transaction_date}}</td>
                                </tr>


                        @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
