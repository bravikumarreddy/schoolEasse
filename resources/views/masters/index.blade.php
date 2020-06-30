@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 m-3">


                <div class="panel-body">
                    <h4 class="card-title ">@lang('Dashboard')</h4>
                    <a class="btn btn-danger btn-lg btn-block" href="{{ route('schools.index') }}" role="button">
                        @lang('Manage Schools')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
