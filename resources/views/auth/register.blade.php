@extends('layouts.app')

@section('title', __('Register'))

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container{{ (\Auth::user()->role == 'master')? '' : '-fluid' }}">
    <div class="row">
        @if(\Auth::user()->role != 'master')
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
        @else
        <div class="col-md-3 " id="side-navbar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('schools.index') }}"><i class="material-icons">gamepad</i> <span class="nav-link-text">@lang('Back to Manage School')</span></a>
                </li>
            </ul>
        </div>
        @endif
        <div class="col-md-8" id="main-container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                    {{-- Display View admin links --}}
                    @if (session('register_school_id'))
                        <a href="{{ url('school/admin-list/' . session('register_school_id')) }}" target="_blank" class="text-white pull-right">@lang('View Admins')</a>
                    @endif
                </div>
            @endif
            <div class="card border-0">
                <h5 class="p-3">@lang('Register') {{ucfirst(session('register_role'))}}</h5>

                <div class="card-body">


                    <form method="POST" id="registerForm" action="{{ url('register/'.session('register_role')) }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label">* @lang('Full Name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required>

                                @if ($errors->has('name'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label">* @lang('E-Mail Address')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label">* @lang('Phone Number')</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}">

                                @if ($errors->has('phone_number'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label">* @lang('Password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label">* @lang('Confirm Password')</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                    required>
                            </div>
                        </div>

                        @if(session('register_role', 'student') == 'student')

                        <div class="form-group row">
                            <label for="section" class="col-md-4 col-form-label">* @lang('Class and Section')</label>

                            <div class="col-md-6">
                                <select id="section" class="form-control {{ $errors->has('section') ? ' is-invalid' : '' }}" name="section" required>
                                    @foreach (session('register_sections') as $section)
                                    <option value="{{$section->id}}">@lang('Section'): {{$section->section_number}} @lang('Class'):
                                        {{$section->class->class_number}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('section'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label">* @lang('Birthday')</label>

                            <div class="col-md-6">
                                <input id="birthday" type="text" class="form-control {{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" value="{{ old('birthday') }}"
                                    required>

                                @if ($errors->has('birthday'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if(session('register_role', 'teacher') == 'teacher')
                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label">* @lang('Department')</label>

                            <div class="col-md-6">
                                <select id="department" class="form-control {{ $errors->has('department') ? ' is-invalid' : '' }}" name="department_id" required>
                                    @if (count(session('departments')) > 0)
                                        @foreach (session('departments') as $d)
                                            <option value="{{$d->id}}">{{$d->department_name}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('department'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('department') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class_teacher" class="col-md-4 col-form-label">@lang('Class Teacher')</label>

                            <div class="col-md-6">
                                <select id="class_teacher" class="form-control {{ $errors->has('class_teacher') ? ' is-invalid' : '' }}" name="class_teacher_section_id">
                                    <option selected="selected" value="0">@lang('Not Class Teacher')</option>
                                    @foreach (session('register_sections') as $section)
                                    <option value="{{$section->id}}">@lang('Section'): {{$section->section_number}} @lang('Class'):
                                        {{$section->class->class_number}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('class_teacher'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('class_teacher') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="blood_group" class="col-md-4 col-form-label">@lang('Blood Group')</label>

                            <div class="col-md-6">
                                <select id="blood_group" class="form-control {{ $errors->has('blood_group') ? ' is-invalid' : '' }}" name="blood_group">
                                    <option selected="selected">A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                    <option>O+</option>
                                    <option>O-</option>
                                </select>

                                @if ($errors->has('blood_group'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('blood_group') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-md-4 col-form-label">* @lang('Nationality')</label>

                            <div class="col-md-6">
                                <input id="nationality" type="text" class="form-control {{ $errors->has('nationality') ? ' is-invalid' : '' }}" name="nationality" value="{{ old('nationality') }}"
                                    required>

                                @if ($errors->has('nationality'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label">@lang('Gender')</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender">
                                    <option selected="selected">@lang('Male')</option>
                                    <option>@lang('Female')</option>
                                </select>

                                @if ($errors->has('gender'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        @if(session('register_role', 'student') == 'student')




                        <div class="form-group row">
                            <label for="session" class="col-md-4 col-form-label">* @lang('Session')</label>

                            <div class="col-md-6">
                                <input id="session" type="text" class="form-control{{ $errors->has('session') ? ' is-invalid' : '' }}" name="session" value="{{ old('session') }}"
                                    required>

                                @if ($errors->has('session'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('session') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="group" class="col-md-4 col-form-label">@lang('Group (Optional)')</label>

                            <div class="col-md-6">
                                <input id="group" type="text" class="form-control{{ $errors->has('group') ? ' is-invalid' : '' }}" name="group" value="{{ old('group') }}"
                                    placeholder="@lang('Science, Arts, Commerce,etc.')">

                                @if ($errors->has('group'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('group') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="religion" class="col-md-4 col-form-label">@lang('Religion')</label>

                            <div class="col-md-6">
                                <select id="religion" class="form-control{{ $errors->has('religion') ? ' is-invalid' : '' }}" name="religion">
                                    <option selected="selected">@lang('Islam')</option>
                                    <option>@lang('Hinduism')</option>
                                    <option>@lang('Christianism')</option>
                                    <option>@lang('Buddhism')</option>
									<option>@lang('Catholic')</option>
                                    <option>@lang('Other')</option>
                                </select>

                                @if ($errors->has('religion'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('religion') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label">* @lang('address')</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}"
                                    required>

                                @if ($errors->has('address'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-md-4 col-form-label">@lang('About')</label>

                            <div class="col-md-6">
                                <textarea id="about" class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}" name="about">{{ old('about') }}</textarea>

                                @if ($errors->has('about'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="father_name" class="col-md-4 col-form-label">* @lang('Father\'s Name')</label>

                            <div class="col-md-6">
                                <input id="father_name" type="text" class="form-control{{ $errors->has('father_name') ? ' is-invalid' : '' }}" name="father_name" value="{{ old('father_name') }}"
                                    required>

                                @if ($errors->has('father_name'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('father_name') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="father_phone_number" class="col-md-4 col-form-label">@lang('Father\'s Phone Number')</label>

                            <div class="col-md-6">
                                <input id="father_phone_number" type="text" class="form-control {{ $errors->has('father_phone_number') ? ' is-invalid' : '' }}" name="father_phone_number"
                                    value="{{ old('father_phone_number') }}">

                                @if ($errors->has('father_phone_number'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('father_phone_number') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="father_national_id" class="col-md-4 col-form-label">@lang('Father\'s National ID')</label>

                            <div class="col-md-6">
                                <input id="father_national_id" type="text" class="form-control{{ $errors->has('father_national_id') ? ' is-invalid' : '' }}" name="father_national_id"
                                    value="{{ old('father_national_id') }}">

                                @if ($errors->has('father_national_id'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('father_national_id') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="father_occupation" class="col-md-4 col-form-label">@lang('Father\'s Occupation')</label>

                            <div class="col-md-6">
                                <input id="father_occupation" type="text" class="form-control{{ $errors->has('father_occupation') ? ' is-invalid' : '' }}" name="father_occupation"
                                    value="{{ old('father_occupation') }}">

                                @if ($errors->has('father_occupation'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('father_occupation') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="father_designation" class="col-md-4 col-form-label">@lang('Father\'s Designation')</label>

                            <div class="col-md-6">
                                <input id="father_designation" type="text" class="form-control{{ $errors->has('father_designation') ? ' is-invalid' : '' }}" name="father_designation"
                                    value="{{ old('father_designation') }}">

                                @if ($errors->has('father_designation'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('father_designation') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="father_annual_income" class="col-md-4 col-form-label">@lang('Father\'s Annual Income')</label>

                            <div class="col-md-6">
                                <input id="father_annual_income" type="text" class="form-control{{ $errors->has('father_annual_income') ? ' is-invalid' : '' }}" name="father_annual_income"
                                    value="{{ old('father_annual_income') }}">

                                @if ($errors->has('father_annual_income'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('father_annual_income') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mother_name" class="col-md-4 col-form-label">* @lang('Mother\'s Name')</label>

                            <div class="col-md-6">
                                <input id="mother_name" type="text" class="form-control{{ $errors->has('mother_name') ? ' is-invalid' : '' }}" name="mother_name" value="{{ old('mother_name') }}"
                                    required>

                                @if ($errors->has('mother_name'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('mother_name') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mother_phone_number" class="col-md-4 col-form-label">@lang('Mother\'s Phone Number')</label>

                            <div class="col-md-6">
                                <input id="mother_phone_number" type="text" class="form-control{{ $errors->has('mother_phone_number') ? ' is-invalid' : '' }}" name="mother_phone_number"
                                    value="{{ old('mother_phone_number') }}">

                                @if ($errors->has('mother_phone_number'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('mother_phone_number') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mother_national_id" class="col-md-4 col-form-label">@lang('Mother\'s National ID')</label>

                            <div class="col-md-6">
                                <input id="mother_national_id" type="text" class="form-control {{ $errors->has('mother_national_id') ? ' is-invalid' : '' }}" name="mother_national_id"
                                    value="{{ old('mother_national_id') }}">

                                @if ($errors->has('mother_national_id'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('mother_national_id') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mother_occupation" class="col-md-4 col-form-label">@lang('Mother\'s Occupation')</label>

                            <div class="col-md-6">
                                <input id="mother_occupation" type="text" class="form-control {{ $errors->has('mother_occupation') ? ' is-invalid' : '' }}" name="mother_occupation"
                                    value="{{ old('mother_occupation') }}">

                                @if ($errors->has('mother_occupation'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('mother_occupation') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mother_designation" class="col-md-4 col-form-label">@lang('Mother\'s Designation')</label>

                            <div class="col-md-6">
                                <input id="mother_designation" type="text" class="form-control {{ $errors->has('mother_designation') ? ' is-invalid' : '' }}" name="mother_designation"
                                    value="{{ old('mother_designation') }}">

                                @if ($errors->has('mother_designation'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('mother_designation') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mother_annual_income" class="col-md-4 col-form-label">@lang('Mother\'s Annual Income')</label>

                            <div class="col-md-6">
                                <input id="mother_annual_income" type="text" class="form-control{{ $errors->has('mother_annual_income') ? ' is-invalid' : '' }}" name="mother_annual_income"
                                    value="{{ old('mother_annual_income') }}">

                                @if ($errors->has('mother_annual_income'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('mother_annual_income') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">@lang('Upload Profile Picture')</label>
                            <div class="col-md-6">
                                <input type="hidden" id="picPath" name="pic_path">
                                @component('components.file-uploader',['upload_type'=>'profile'])
                                @endcomponent
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-4">
                                <button type="submit" id="registerBtn" class="btn btn-primary">
                                    @lang('Register')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function () {
        $('#birthday').datepicker({
            format: "yyyy-mm-dd",
        });
        $('#session').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    });
    $('#registerBtn').click(function () {
        $("#registerForm").submit();
    });
</script>
@endsection
