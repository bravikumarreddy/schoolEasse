@extends('layouts.app')

@section('title', __('Grade'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-lg" id="main-container">
            <h2>@lang('Marks and Grades of All Classes')</h2>
            <div class="card border-0">
              @if(count($classes) > 0)
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($classes as $class)
                        <div class="card border-0">
                            <div class="card-title" role="tab" id="heading{{$class->id}}">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}">
                                <h5>
                                {{$class->class_number}} {{$class->group}} <span class="float-right"><b>@lang('Click to view all Sections under this Class')+</b></span>
                                </h5>
                            </a>
                            </div>
                            <div id="collapse{{$class->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$class->id}}">
                                <div class="panel-body">
                                    <table class="table  table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">@lang('Section Name')</th>
                                                <th scope="col">@lang('View Each Student\'s Grade History')</th>
                                                <th scope="col">@lang('View all Students Marks under this Section')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sections as $section)
                                                @if($class->id == $section->class_id)
                                                <tr>
                                                <td>
                                                    <a href="{{url('grades/section/'.$section->id)}}">{{$section->section_number}}</a>
                                                </td>
                                                <td>
                                                    <a href="{{url('section/students/'.$section->id)}}" class=" m-0 pl-1 pr-1 pt-1 pb-1 btn text-sm btn-info btn-xs"><i class="material-icons">visibility</i> @lang('View Each Student\'s Grade History')</a>
                                                </td>
                                                <td>
                                                    <a href="{{url('grades/section/'.$section->id)}}" role="button" class=" m-0 pl-1 pr-1 pt-1 pb-1 btn btn-xs btn-danger"><i class="material-icons">visibility</i> @lang('View all Students Marks under this Section')</a>
                                                </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
              @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
