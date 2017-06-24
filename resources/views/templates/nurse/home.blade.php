@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.nurse.home-header')
@stop

@if(Auth::user()->hasRole('administrator'))
	@section('aside')
		@include('templates.admin.aside')
	@stop
@elseif(Auth::user()->hasRole('nurse'))
	@section('aside')
		@include('templates.nurse.aside')
	@stop
@endif

@section('body')
	@include('templates.nurse.home-blocks')
	@include('templates.main.statistics')
	@include('templates.admin.individual-activity')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
