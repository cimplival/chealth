@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.admin.activities-header')
@stop

@section('aside')
	@if(Auth::user()->hasRole('administrator'))
		@include('templates.admin.aside')
	@elseif(Auth::user()->hasRole('accountant'))
		@include('templates.accounts.aside')
	@elseif(Auth::user()->hasRole('receptionist') && !Auth::user()->hasRole('doctor'))
		@include('templates.reception.aside')
	@elseif(Auth::user()->hasRole('triage'))
		@include('templates.triage.aside')
	@elseif(Auth::user()->hasRole('doctor'))
		@include('templates.doctor.aside')
	@elseif(Auth::user()->hasRole('pharmacy'))
		@include('templates.pharmacy.aside')
	@elseif(Auth::user()->hasRole('nurse'))
		@include('templates.nurse.aside')
	@elseif(Auth::user()->hasRole('laboratorist'))
		@include('templates.lab.aside')
	@endif
@stop

@section('body')
	@include('templates.admin.activities-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
