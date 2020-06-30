@extends('layouts.app')

@section('title', __('Add Routine'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="card border-0">

                <div class="panel-body">
                    <h4 class="card-title">@lang('Add Routine')
                    </h4>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.file-uploader',['upload_type'=>'routine','classes'=>$classes,'sections'=>$sections])
                    @endcomponent
                    @component('components.uploaded-files-list',['files'=>$files,'parent'=>($section_id !== 0)?'section':'','upload_type'=>'routine'])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
