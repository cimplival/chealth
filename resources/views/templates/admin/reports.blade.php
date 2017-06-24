@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.admin.reports-header')
@stop

@section('aside')
	@include('templates.admin.aside')
@stop

@section('body')
	@include('templates.admin.reports-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
