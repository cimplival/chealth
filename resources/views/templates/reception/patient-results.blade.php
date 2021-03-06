@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.reception.patients-header')
@stop

@if(Auth::user()->hasRole('administrator'))
	@section('aside')
		@include('templates.admin.aside')
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

@if(Auth::user()->hasRole('receptionist'))
	@section('aside')
		@include('templates.reception.aside')
	@stop
@endif


@section('body')
	@include('templates.reception.patients-body')
	@include('templates.reception.patient-results-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
