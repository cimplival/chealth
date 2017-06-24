@extends('templates.main.home')

@section('header')
  @include('templates.sub-sections.nav.header')
@stop

@section('main-header')
  @include('templates.sub-sections.nav.main-header')
@stop

@section('sign-in')
@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

  <div class="col-md-5">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">Forgot My Password</div>
    <div class="panel-body">
      <form role="form" method="POST" action="{{ url('/password/email') }}">{{ csrf_field() }}
      <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} focus">
        <input class="form-control username focus" type="email" name="email" autocomplete="off" value="{{ old('email') }}" placeholder="Enter email" required>
        @if ($errors->has('email'))
          <span class="help-block text-danger text-center">
            <small><strong>{{ $errors->first('email') }}</strong></small>
          </span>
          @endif
      </div>

      <div class="form-group text-center">
        <a type="submit" href="{{ url('/') }}" class="btn m-b-xs btn-default btn-addon btn-md pull-left"><i class="fa fa-lock"></i>Sign in</a>
        <button type="submit" class="btn m-b-xs btn-primary btn-addon btn-md pull-right">
        <i class="fa fa-envelope"></i>Send a reset link</button>
      </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('medical-stats')
  @include('templates.sub-sections.body.medical-stats')
@stop

@section('footer')
  @include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
  @include('templates.main.scripts')
@stop
