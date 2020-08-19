@extends('layouts.app')
@section('title', __('Add GPA System'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-lg" id="main-container">
            <div class="card border-0">


                <div class="card-body">
                    <h4 class="card-title">@lang('Add GPA System')</h4>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="offset-3" action="{{url('create-gpa')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group row">
                          <label for="grade_system_name" class="col-md-3 col-form-label">@lang('Grade System Name')</label>

                          <div class="col-md-6">
                              <input id="grade_system_name" type="text" class="form-control{{ $errors->has('grade_system_name') ? ' is-invalid' : '' }}" name="grade_system_name" value="{{ old('grade_system_name') }}" placeholder="@lang('Grade System Name')" required>

                              @if ($errors->has('grade_system_name'))
                                     <div class="invalid-feedback d-block">
                                      <strong>{{ $errors->first('grade_system_name') }}</strong>
                                  </div>
                              @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="grade" class="col-md-3 col-form-label">@lang('Grade')</label>

                          <div class="col-md-6">
                              <input id="grade" type="text" class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}" name="grade" value="{{ old('grade') }}" placeholder="A+, A, A-, B+, ..." required>

                              @if ($errors->has('grade'))
                                     <div class="invalid-feedback d-block">
                                      <strong>{{ $errors->first('grade') }}</strong>
                                  </div>
                              @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="point" class="col-md-3 col-form-label">@lang('Grade Point')</label>

                          <div class="col-md-6">
                              <input id="point" type="text" class="form-control {{ $errors->has('point') ? ' is-invalid' : '' }}" name="point" value="{{ old('point') }}" placeholder="5.00, 4.50, ..." required>

                              @if ($errors->has('point'))
                                     <div class="invalid-feedback d-block">
                                      <strong>{{ $errors->first('point') }}</strong>
                                  </div>
                              @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="from_mark" class="col-md-3 col-form-label">@lang('From Mark')</label>

                          <div class="col-md-6">
                              <input id="from_mark" type="text" class="form-control{{ $errors->has('from_mark') ? ' is-invalid' : '' }}" name="from_mark" value="{{ old('from_mark') }}" placeholder="@lang('Example: 80')" required>

                              @if ($errors->has('from_mark'))
                                     <div class="invalid-feedback d-block">
                                      <strong>{{ $errors->first('from_mark') }}</strong>
                                  </div>
                              @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="to_mark" class="col-md-3 col-form-label">@lang('To Mark')</label>

                          <div class="col-md-6">
                              <input id="to_mark" type="text" class="form-control{{ $errors->has('to_mark') ? ' is-invalid' : '' }}" name="to_mark" value="{{ old('to_mark') }}" placeholder="@lang('Example: 90')" required>

                              @if ($errors->has('to_mark'))
                                     <div class="invalid-feedback d-block">
                                      <strong>{{ $errors->first('to_mark') }}</strong>
                                  </div>
                              @endif
                          </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-4 col-sm-8">
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
