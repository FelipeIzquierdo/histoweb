@extends('dashboard.pages.layout')
	@section('title') 
	    Sistema de Administración
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-desktop"></i>
			Administración
		</h1>
	@endsection

	@section('breadcrumbs')
		{!! Breadcrumbs::render('admin') !!}
	@endsection
	
	@section('dashboard_body')

	@if ( Auth::user()->role_id == '2' || Auth::user()->role_id == '1' )

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system'), 'icon_widget' => 'img/placeholders/icons/system.png', 'title_widget' => 'Sistema'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.company'), 'icon_widget' => 'img/placeholders/icons/open.png', 'title_widget' => 'Institución'])

	@endif

	@if ( Auth::user()->role_id == '3' || Auth::user()->role_id == '1' )

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('reception'), 'icon_widget' => 'img/placeholders/icons/reception.png', 'title_widget' => 'Recepción'])

	@endif

	@if ( Auth::user()->role_id == '4' || Auth::user()->role_id == '6' || Auth::user()->role_id == '1' )

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('assistance'), 'icon_widget' => 'img/placeholders/icons/assistance.png', 'title_widget' => 'Asistencia'])
		
	@endif

	@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('telemedicine'), 'icon_widget' => 'img/placeholders/icons/telemedicine.png', 'title_widget' => 'Telemedicina'])

	@endsection