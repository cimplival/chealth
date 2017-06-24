@if (Session::has('info'))
@include('templates.sub-sections.alerts.info')
@endif
@if (Session::has('success'))
@include('templates.sub-sections.alerts.success')
@endif
@if (count($errors) > 0)
@include('templates.sub-sections.alerts.errors')
@endif
<div class="panel panel-default">
    <div class="panel-heading font-bold">
      General Settings
    </div>
    <div class="panel-body">
      {!! Form::open(['method'=>'PUT','action'=>['Admin\SettingsController@updateSettings', 1]])!!}
        <div class="form-group">
          <label class="col-sm-2 control-label">Name of Institution</label>
          <div class="col-sm-10">
            <input name="name_of_institution" class="form-control" type="text" value="{{ $settings->name_of_institution }}">
            <span class="help-block m-b-none text-italic"><small>Name of the Institution that owns a license to use this software.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Tagline</label>
          <div class="col-sm-10">
            <input name="tagline" class="form-control" type="text" value="{{ $settings->tagline }}">
            <span class="help-block m-b-none text-italic"><small>Tagline of the Institution that owns a license to use this software.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Email address</label>
          <div class="col-sm-10">
            <input name="email_address" class="form-control" type="email" value="{{ $settings->email_address }}" >
            <span class="help-block m-b-none text-italic"><small>Email address of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Phone</label>
          <div class="col-sm-10">
            <input name="phone_no" class="form-control" type="phone" value="{{ $settings->phone_no }}" >
            <span class="help-block m-b-none text-italic"><small>Main Phone no. of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Currency</label>
          <div class="col-sm-10">
            <input name="currency" class="form-control" type="phone" value="{{ $settings->currency }}" >
            <span class="help-block m-b-none text-italic"><small>Currency</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Postal Address</label>
          <div class="col-sm-10">
            <input name="postal_address" class="form-control" type="text" value="{{ $settings->postal_address }}" >
            <span class="help-block m-b-none text-italic"><small>Postal address of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Location</label>
          <div class="col-sm-10">
            <input name="location" class="form-control" type="text" value="{{ $settings->location }}" >
            <span class="help-block m-b-none text-italic"><small>Location of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Website</label>
          <div class="col-sm-10">
            <input name="website" class="form-control" type="text" value="{{ $settings->website }}" >
            <span class="help-block m-b-none text-italic"><small>Website of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <div class="col-sm-4 col-sm-offset-8">
            <button type="submit" class="btn btn-success btn-sm pull-right">Save General Settings</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>