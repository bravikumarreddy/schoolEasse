@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <br>

                <h4>Fee Structures</h4>
                <br>
                <a class="btn btn-success btn-block" role="button" href="/fees/fee_structures/create" >
                    + Create new fee structure
                </a>
                <br class="border-0" >
                <br class="border-0">
                    <table class="table table-sm table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">Index</th>
                            <th scope="col">@lang('Name')</th>



                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($fee_structures as $indexKey => $fee_structure)
                            <tr>
                                <td>{{$indexKey+1}}</td>
                                <td>{{$fee_structure->name}}</td>


                                <td>
                                    <form id="form-id" method="post" action="/fees/fee_structures/duplicate">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$fee_structure->id}}">
                                        <button class="btn btn-sm btn-info" type="submit">
                                            @lang('Duplicate')
                                        </button>

                                    </form>
                                </td>
{{--                                <td>--}}
{{--                                    <form id="form-id" method="get" action="/fees/fee_structures/create">--}}
{{--                                        <input type="hidden" name="id" value="{{$fee_structure->id}}">--}}
{{--                                        <button class="btn-xs btn-warning" type="submit">--}}
{{--                                            <small>@lang('Edit')</small>--}}
{{--                                        </button>--}}

{{--                                    </form>--}}
{{--                                </td>--}}
                                <td>
                                    <form id="form-id" method="post" action="/fees/fee_structures">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$fee_structure->id}}">
                                        <button class=" btn btn-sm btn-danger" type="submit">
                                            @lang('Delete')
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>



@endsection
