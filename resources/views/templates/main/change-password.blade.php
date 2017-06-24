@extends('templates.main.home')

@section('header')
@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
@include('templates.main.change-header')
@stop

@if(Auth::user()->hasRole('administrator'))
@section('aside')
@include('templates.admin.aside')
@stop
@endif

@if(Auth::user()->hasRole('accountant'))
@section('aside')
@include('templates.accounts.aside')
@stop
@endif

@if(Auth::user()->hasRole('doctor'))
@section('aside')
@include('templates.doctor.aside')
@stop
@endif

@if(Auth::user()->hasRole('nurse'))
@section('aside')
@include('templates.nurse.aside')
@stop
@endif

@if(Auth::user()->hasRole('pharmacy'))
@section('aside')
@include('templates.pharmacy.aside')
@stop
@endif

@if(Auth::user()->hasRole('receptionist'))
@section('aside')
@include('templates.reception.aside')
@stop
@endif

@if(Auth::user()->hasRole('triage'))
@section('aside')
@include('templates.triage.aside')
@stop
@endif

@if(Auth::user()->hasRole('laboratory'))
@section('aside')
@include('templates.lab.aside')
@stop
@endif

@section('body')
@if (Session::has('info'))
@include('templates.sub-sections.alerts.info')
@endif
@if (Session::has('success'))
@include('templates.sub-sections.alerts.success')
@endif
@if (count($errors) > 0)
@include('templates.sub-sections.alerts.errors')
@endif
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading font-bold"></div>
		<div class="panel-body">
			<form role="form" method="POST" action="{{ url('change-password') }}">{{ csrf_field() }}
				<div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
					<input class="form-control password focus" placeholder="Original Password" type="password" name="old_password" autocomplete="off" required>
					@if ($errors->has('old_password'))
					<span class="help-block">
						<small><strong>{{ $errors->first('old_password') }}</strong></small>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
					<input class="form-control password" placeholder="New Password" type="password" name="new_password" autocomplete="off" required>
					@if ($errors->has('new_password'))
					<span class="help-block">
						<small><strong>{{ $errors->first('new_password') }}</strong></small>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
					<input class="form-control password" placeholder="Confirm New Password" type="password" name="confirm_password" autocomplete="off" required>
					@if ($errors->has('confirm_password'))
					<span class="help-block">
						<small><strong>{{ $errors->first('confirm_password') }}</strong></small>
					</span>
					@endif
				</div>

				<div class="form-group text-center">
					<button type="submit" class="btn m-b-xs btn-sm btn-info pull-right">Change Password</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop

