@extends('layouts.app')

@section('title', __('Manage Schools'))

@section('content')
    <div class="container-fluid">
        <div class="col-md-12" id="main-container">
            <div class="card border-0">
                <div class="card-body table-responsive">
                    @include('schools.form')
                    <h3 class="card-title p-2 m-2">@lang('School List')</h3>

                    <table class="table table-borderless">
                        <thead >
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Code')</th>
                                <th scope="col">@lang('About')</th>
                                <th scope="col">@lang('Edit')</th>
                                <th scope="col">+@lang('Admin')</th>
                                <th scope="col">@lang('View Admins')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)
                                <tr>
                                    <td>{{($loop->index + 1)}}</td>
                                    <td><small>{{$school->name}}</small></td>
                                    <td><small>{{$school->code}}</small></td>
                                    <td><small>{{$school->about}}</small></td>
                                    <td>
                                        <a class="btn btn-success btn-sm" role="button" href="{{ route('schools.edit', $school) }}" dusk="edit-school-link">
                                            <small>@lang('Edit School')</small>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" role="button" href="{{url('register/admin/'.$school->id.'/'.$school->code)}}">
                                            <small>+ @lang('Create Admin')</small>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm" role="button" href="{{url('school/admin-list/'.$school->id)}}">
                                            <small>@lang('View Admins')</small>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $schools->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
