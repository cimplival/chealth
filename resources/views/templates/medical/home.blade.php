@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.medical.main-header')
@stop

@section('aside')
	@include('templates.doctor.aside')
@stop


@section('body')
	@include('templates.medical.body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
	@include('templates.medical.scripts')
	@include('templates.pharmacy.scripts')
@stop
