@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Telemedicina</h1>
@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('telemedicine') !!}
@endsection

@section('dashboard_body')

    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('telediagnostic'), 'icon_widget' => 'img/placeholders/icons/telediagnostic.png', 'title_widget' => 'Telediagnóstico'])

    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('teleconsult'), 'icon_widget' => 'img/placeholders/icons/teleconsult.png', 'title_widget' => 'Teleconsulta'])

    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('call'), 'icon_widget' => 'img/placeholders/icons/call.png', 'title_widget' => 'Llamada'])

@endsection




