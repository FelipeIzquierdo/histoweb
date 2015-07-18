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
	
	@section('breadcrumbs')
		{!! Breadcrumbs::render('medicament') !!}
	@endsection

	@section('dashboard_body')
		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.presentations.index'), 'icon_widget' => 'img/placeholders/icons/presentation.png', 'title_widget' => 'Presentaciones'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.units.index'), 'icon_widget' => 'img/placeholders/icons/units.png', 'title_widget' => 'Unidades'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.diluents.index'), 'icon_widget' => 'img/placeholders/icons/duilent.png', 'title_widget' => 'Diluyentes'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.labs.index'), 'icon_widget' => 'img/placeholders/icons/labs.png', 'title_widget' => 'Laboratorios'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.administration-routes.index'), 'icon_widget' => 'img/placeholders/icons/via_medicament.png', 'title_widget' => 'Via de administración'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.generic-medications.index'), 'icon_widget' => 'img/placeholders/icons/generic_medicament.png', 'title_widget' => 'Medicamentos Genéricos'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.commercial-medications.index'), 'icon_widget' => 'img/placeholders/icons/commercial_medicament.png', 'title_widget' => 'Medicamentos Comerciales'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament.concentrations.index'), 'icon_widget' => 'img/placeholders/icons/concentration.png', 'title_widget' => 'Concentraciones'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => '#', 'icon_widget' => 'img/placeholders/icons/inventary.png', 'title_widget' => 'Inventario'])

	@endsection