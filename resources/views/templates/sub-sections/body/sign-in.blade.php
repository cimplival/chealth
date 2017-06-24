@if (Session::has('info'))
@include('templates.sub-sections.alerts.info')
@endif
@if (Session::has('success'))
@include('templates.sub-sections.alerts.success')
@endif
@if (Session::has('error'))
@include('templates.sub-sections.alerts.error')
@endif
@if (count($errors) > 0)
@include('templates.sub-sections.alerts.errors')
@endif
<div class="col-md-5">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">Sign in below</div>
    <div class="panel-body">
      {!! Form::open(array(
      'url'     => '/',
      'action'  => 'route(;home")',
      'method'  => 'POST',
      'role'    => 'form'
      )) 
      !!}
      <div class="form-group">
        <input class="form-control username focus" placeholder="Enter Username" type="text" name="user_name" autocomplete="off" required>
      </div>
      <div class="form-group">
        <input class="form-control password" placeholder="Password" type="password" name="password" autocomplete="off" required>
      </div>
      <div class="checkbox">
        <label class="i-checks">
          <input type="checkbox" name="remember"><i></i> Remember me
        </label>
      </div>

      <div class="form-group">
        <button type="submit" class="btn m-b-xs btn-success btn-addon btn-md pull-right">
        <i class="fa fa-lock"></i>Sign in</button>
      </div><br><br>
      <div class="pull-right">
      {!! Form::close() !!}
      <a href="{{ url('/password/reset') }}"><small class="text-muted text-xs">Forgot your Password?</small></a>
      </div>
    </div>
  </div>
</div>
