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

                <h4>Collect Fees</h4>

                <div id="example" classes={{$classes}}>

                </div>
{{--                <table class="table table-striped">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">Index</th>--}}
{{--                        <th scope="col">@lang('Name')</th>--}}

{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach ($students as $indexKey => $student)--}}
{{--                        <form id="form-id" method="post" action="/fees/collect/invoice">--}}
{{--                            @csrf--}}
{{--                        <tr>--}}
{{--                            <td>{{$indexKey+1}} </td>--}}
{{--                            <td>--}}
{{--                                {{$student->name}}--}}
{{--                                <input type="hidden" name="student_name" value="{{$student->name}}">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <select class="custom-select" name="fee_structure" required>--}}
{{--                                    <option value="">Select fee structure</option>--}}
{{--                                    @foreach( $fee_structures as $fee_structure)--}}
{{--                                        <option value="{{$fee_structure->id}}">{{$fee_structure->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </td>--}}

{{--                            <td>--}}


{{--                                    <button class="btn-xs btn-info" type="submit">--}}
{{--                                        <small>@lang('Collect')</small>--}}
{{--                                    </button>--}}


{{--                            </td>--}}
{{--                        </form>--}}


{{--                        </tr>--}}
{{--                    @endforeach--}}
                    </tbody>
                </table>
                <script src="{{asset('js/app.js')}}"></script>

            </div>
        </div>
    </div>

    </div>



@endsection
