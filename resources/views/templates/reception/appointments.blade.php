@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.reception.appointments-header')
@stop

@if(Auth::user()->hasRole('administrator'))
	@section('aside')
		@include('templates.admin.aside')
	@stop
@endif

@if(Auth::user()->hasRole('receptionist'))
	@section('aside')
		@include('templates.reception.aside')
	@stop
@endif

@section('body')
	@include('templates.reception.appointments-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop

