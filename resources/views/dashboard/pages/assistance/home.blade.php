@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Asistencia, Doctor {{ $doctor->name }} </h1>
@endsection

@section('sidebar_menu')
	@include('dashboard.pages.assistance.menu') 
@endsection

@section('dashboard_body')
	

@endsection

@section('js_extra')
	
@endsection

