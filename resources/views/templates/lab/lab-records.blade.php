@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.lab.lab-records-header')
@stop

@if(Auth::user()->hasRole('administrator'))
	@section('aside')
		@include('templates.admin.aside')
	@stop
@elseif(Auth::user()->hasRole('laboratorist'))
	@section('aside')
		@include('templates.lab.aside')
	@stop
@endif

@section('body')
	@include('templates.lab.lab-records-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
	@include('templates.pharmacy.scripts')
@stop
