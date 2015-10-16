@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Asistencia, Dr {{ $doctor->name }} </h1>
@endsection

@section('sidebar_menu')
	@include('dashboard.pages.assistance.menu') 
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('assistance') !!}
@endsection

@section('dashboard_body')
	

@endsection

@section('js_extra')
	
@endsection

