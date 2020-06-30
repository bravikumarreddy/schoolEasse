@extends('layouts.app')

@section('title', __('Edit School'))

@section('content')
    <div class="card border-0">
        <div class="panel-body">
            <h3 class="text-center p-3">@lang('Edit') {{$school->name}}</h3>

            <form  action="{{ route('schools.update', $school) }}" method="post">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}

                <div class="form-group offset-3 row">
                    <label for="name" class="col-form-label">@lang('School Name')</label>

                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $school->name }}"  placeholder="@lang('School Name')" required>

                        @if ($errors->has('name'))
                            <div class="invalid-feedback d-block ">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group offset-3 row">
                    <label for="about" class="col-form-label">@lang('About School')</label>

                    <div class="col-md-8">
                        <textarea id="about" type="text" class="form-control {{ $errors->has('about') ? ' is-invalid' : '' }} " name="about"
                            placeholder="@lang('About School')" required>{{ $school->about }}</textarea>

                        @if ($errors->has('about'))
                            <div class="invalid-feedback d-block ">
                                <strong>{{ $errors->first('about') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group offset-4 row">
                    <div class="offset-2 col-md-8">
                        <a href="{{ route('schools.index') }}" class="btn btn-primary">@lang('Back')</a>
                        <button type="submit" class="btn btn-danger">@lang('Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
