@extends('layouts.app')

@section('title', __('Login'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="main-container">
            <div class="card border-0">

                
                @if ($errors->any())
                    <div class="alert alert-danger mt-2" role="alert">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <h3 class="card-title">@lang('Login')</h3>


                    <form  method="POST" class="offset-3" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="email" class="col-3 col-form-label">@lang('E-Mail Or Phone Number')</label>
                            <div class="col-4">
                                <input id="email" type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>


                                @if ($errors->has('email'))
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>


                        </div>

                        <div class="form-group row ">
                            <label for="password" class="col-3 col-form-label">@lang('Password')</label>

                            <div class="col-4">
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>


                        </div>
                        {{--
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('Remember Me')
                                    </label>
                                </div>
                            </div>
                        </div>
                        --}}
                        <div class="form-group row">
                            <div class="col-7 text-right">
                                <button type="submit" class="btn btn-primary">
                                    @lang('Login')
                                </button>
                                {{--
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('Forgot Your Password?')
                                </a>
                                --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
