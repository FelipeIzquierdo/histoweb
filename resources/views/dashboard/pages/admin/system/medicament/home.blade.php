@extends('dashboard.pages.layout')
	@section('title') 
	    Administración del Sistema
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-desktop"></i>
			Medicamentos
		</h1>
	@endsection
	
	@section('dashboard_body')
		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.presentations.index'), 'icon_widget' => 'img/placeholders/icons/presentation.png', 'title_widget' => 'Presentaciones'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.via-medicaments.index'), 'icon_widget' => 'img/placeholders/icons/via_medicament.png', 'title_widget' => 'Via del medicamento'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.medicaments.index'), 'icon_widget' => 'img/placeholders/icons/medicaments.png', 'title_widget' => 'Medicamentos'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.measures.index'), 'icon_widget' => 'img/placeholders/icons/measure.png', 'title_widget' => 'Medidas'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.inventaries.index'), 'icon_widget' => 'img/placeholders/icons/inventary.png', 'title_widget' => 'Inventario'])

	@endsection