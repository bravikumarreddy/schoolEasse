<button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#schoolModal" dusk="create-school-button">
    + @lang('Create School')
</button>

<!-- Modal -->
<div class="modal fade" id="schoolModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal" method="POST" action="{{ route('schools.store') }}">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">@lang('Create School')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">@lang('School Name')</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('school_name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="@lang('School Name')" required>

                            @if ($errors->has('name'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="medium" class="col-md-4 col-form-label">@lang('School Medium')</label>

                        <div class="col-md-6">
                            <select id="medium" class="form-control{{ $errors->has('medium') ? ' is-invalid' : '' }}" name="medium">
                                <option selected="selected">@lang('English')</option>
                                <option>@lang('Tamil')</option>
                                <option>@lang('Hindi')</option>
                                <option>@lang('Telugu')</option>

                            </select>

                            @if ($errors->has('medium'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('medium') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="established" class="col-md-4 col-form-label">@lang('School Established')</label>

                        <div class="col-md-6">
                            <input id="established" type="text" class="form-control{{ $errors->has('established') ? ' is-invalid' : '' }}" name="established" value="{{ old('established') }}" placeholder="@lang('School Established')" required>

                            @if ($errors->has('established'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('established') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="about" class="col-md-4 col-form-label">@lang('About')</label>

                        <div class="col-md-6">
                            <textarea id="about" class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}" rows="3" name="about" placeholder="@lang('About School')" required>{{ old('about') }}</textarea>

                            @if ($errors->has('about'))
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Save changes')</button>
                </div>
            </div>
        </form>
    </div>
</div>
