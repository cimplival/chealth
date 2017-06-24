<!-- 

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i> Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->


@extends('templates.main.home')

@section('header')
@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
@include('templates.sub-sections.nav.main-header')
@stop

@section('sign-in')


<div class="col-md-5">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">Reset Password</div>
    <div class="panel-body">
      <form role="form" method="POST" action="{{ url('/password/reset') }}">{{ csrf_field() }}
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} focus">
            <input class="form-control username focus" type="email" name="email" autocomplete="off" value="{{ old('email') }}" placeholder="Enter email" required>
            @if ($errors->has('email'))
            <span class="help-block text-danger text-center">
                <small><strong>{{ $errors->first('email') }}</strong></small>
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <input class="form-control password" placeholder="Password" type="password" name="password" autocomplete="off" required>
            @if ($errors->has('password'))
            <span class="help-block">
                <small><strong>{{ $errors->first('password') }}</strong></small>
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input class="form-control password" placeholder="Password Confirmation" type="password" name="password_confirmation" autocomplete="off" required>
            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <small><strong>{{ $errors->first('password_confirmation') }}</strong></small>
            </span>
            @endif
        </div>

        <div class="form-group text-center">
            <a type="submit" href="{{ url('/') }}" class="btn m-b-xs btn-default btn-addon btn-md pull-left">
                <i class="fa fa-lock"></i>Sign in</a>
            <button type="submit" class="btn m-b-xs btn-primary btn-addon btn-md pull-right">
                <i class="fa fa-refresh"></i>Reset Password</button>
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
