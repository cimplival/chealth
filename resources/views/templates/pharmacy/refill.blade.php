@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('header-appointments')
	@include('templates.pharmacy.header-refill')
@stop

@section('main-header-appointments')
	@include('templates.pharmacy.main-header-refill')
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
	@include('templates.pharmacy.refill-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
