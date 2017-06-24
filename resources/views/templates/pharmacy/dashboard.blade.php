@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.pharmacy.main-header')
@stop

@section('aside')
	@include('templates.pharmacy.aside')
@stop

@section('doctor-blocks')
	@include('templates.pharmacy.blocks')
@stop

@section('doctor-medical-stats')
	@include('templates.main.statistics')
@stop

@section('body')
	@include('templates.admin.individual-activity')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop


