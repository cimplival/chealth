@extends('templates.main.home')

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<div class="col-md-5">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">Sign in below</div>
    <div class="panel-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
          <div class="form-group">
            <button type="submit" class="btn m-b-xs btn-primary btn-addon btn-md pull-right">
              <i class="fa fa-lock"></i>Send Password Reset Link</button>
          </div><br><br>
      </form>
    </div>
  </div>
</div>
