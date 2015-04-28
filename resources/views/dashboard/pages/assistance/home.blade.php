@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Asistencia, Doctor {{ $doctor->name }} </h1>
    <h1>
		<a href="{{ route('assistance.formulate.create') }}" class="btn btn-info" title="Nuevo diagnóstico">
			Formular
		</a>
	</h1>
@endsection

@section('sidebar_menu')
	@include('dashboard.pages.assistance.menu') 
@endsection

@section('dashboard_body')
	

@endsection

@section('js_extra')
	
@endsection

