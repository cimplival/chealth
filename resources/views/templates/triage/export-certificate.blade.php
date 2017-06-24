@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.triage.certificate-header')
@stop

@if(Auth::user()->hasRole('administrator'))
	@section('aside')
		@include('templates.admin.aside')
	@stop
@elseif(Auth::user()->hasRole('triage'))
	@section('aside')
		@include('templates.triage.aside')
	@stop
@endif

@section('body')
	@include('templates.triage.export-certificate-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
	@include('templates.medical.scripts')
	@include('templates.pharmacy.scripts')
@stop
