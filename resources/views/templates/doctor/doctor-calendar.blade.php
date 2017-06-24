@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header-calendar')
	@include('templates.doctor.main-header-calendar')
@stop

@section('aside')
	@include('templates.doctor.aside')
@stop

@section('doctor-calendar-body')
	@include('templates.doctor.doctor-calendar-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
