@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.triage.main-header')
@stop

@section('aside')
	@include('templates.triage.aside')
@stop

@section('doctor-blocks')
	@include('templates.triage.blocks')
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


