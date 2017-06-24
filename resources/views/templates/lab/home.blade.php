@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.lab.home-header')
@stop

@section('aside')
	@include('templates.lab.aside')
@stop

@section('body')
	@include('templates.lab.home-blocks')
	@include('templates.main.statistics')
	@include('templates.admin.individual-activity')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
