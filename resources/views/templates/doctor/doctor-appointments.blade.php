@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('header-appointments')
	@include('templates.doctor.header-appointments')
@stop

@section('main-header-appointments')
	@include('templates.doctor.main-header-appointments')
@stop


@section('aside')
	@include('templates.doctor.aside')
@stop

@section('doctor-appointments-body')
	@include('templates.doctor.doctor-appointments-body')
@stop


@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
