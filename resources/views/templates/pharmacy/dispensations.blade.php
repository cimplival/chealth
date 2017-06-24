@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('header-appointments')
	@include('templates.pharmacy.header-dispensations')
@stop

@section('main-header')
	@include('templates.pharmacy.main-header-dispensations')
@stop

@if(Auth::user()->hasRole('administrator'))
	@section('aside')
		@include('templates.admin.aside')
	@stop
@elseif(Auth::user()->hasRole('pharmacy'))
	@section('aside')
		@include('templates.pharmacy.aside')
	@stop
@endif

@section('doctor-appointments-body')
	@include('templates.pharmacy.dispensations-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
	@include('templates.pharmacy.scripts')
@stop
