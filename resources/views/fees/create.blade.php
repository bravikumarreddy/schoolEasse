@extends('layouts.app')

@section('title', __('Add Form Field'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>


        <div class="col-lg" id="main-container">
            <div class="card border-0">

                <div class="panel-body">
                    <h4 class="card-title">@lang('Add Form Field')
                    </h4>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{url('fees/create')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('fee_name') ? ' has-error' : '' }}">
                          <label for="fee_name" class="col-md-4 control-label">@lang('Form Field Name')</label>

                          <div class="col-md-6">
                              <input id="fee_name" type="text" class="form-control" name="fee_name" value="{{ old('fee_name') }}" placeholder="@lang('Form Field Name')" required>

                              @if ($errors->has('fee_name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('fee_name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                          <button type="submit" class="btn btn-danger">@lang('Save')</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
