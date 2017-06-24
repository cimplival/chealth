@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header-consultations')
	@include('templates.doctor.main-header-consultations')
@stop

@section('aside')
	@include('templates.doctor.aside')
@stop

@section('doctor-consultations-body')
	@include('templates.doctor.doctor-history-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
