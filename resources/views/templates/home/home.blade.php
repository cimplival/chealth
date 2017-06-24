@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('aside')
	@include('templates.sub-sections.aside.aside')
@stop

@section('main-header')
	@include('templates.sub-sections.nav.main-header')
@stop

@section('sign-in')
	@include('templates.sub-sections.body.sign-in')
@stop

@section('medical-stats')
	@include('templates.sub-sections.body.medical-stats')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
