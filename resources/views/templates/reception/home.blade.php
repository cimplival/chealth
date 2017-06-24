@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('reception-header-home')
	@include('templates.reception.reception-header-home')
@stop

@section('aside')
	@include('templates.reception.aside')	
@stop

@section('reception-home-blocks')
	@include('templates.reception.reception-home-blocks')
@stop

@section('reception-home-statistics')
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
