@extends('dashboard.pages.layout')
	@section('title') 
	    Administración del Sistema
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-desktop"></i>
			Administración del Sistema
		</h1>
	@endsection
	
	@section('dashboard_body')
		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.tools.index'), 'icon_widget' => 'img/placeholders/icons/tool.png', 'title_widget' => 'Herramientas'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.specialties.index'), 'icon_widget' => 'img/placeholders/icons/student.png', 'title_widget' => 'Especialidades'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.diary-types.index'), 'icon_widget' => 'img/placeholders/icons/medical.png', 'title_widget' => 'Tipos de citas'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.memberships.index'), 'icon_widget' => 'img/placeholders/icons/assistance.png', 'title_widget' => 'Tipos de afiliación'])
	@endsection