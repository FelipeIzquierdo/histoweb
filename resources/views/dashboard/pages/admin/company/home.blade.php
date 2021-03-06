@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Institución</h1>
@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('company') !!}
@endsection

@section('dashboard_body')
    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.company.surgeries.index'), 'icon_widget' => 'img/placeholders/icons/build.png', 'title_widget' => 'Consultorios'])

    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.company.doctors.index'), 'icon_widget' => 'img/placeholders/icons/doctor.png', 'title_widget' => 'Doctores'])

    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.company.patients.index'), 'icon_widget' => 'img/placeholders/icons/patient.png', 'title_widget' => 'Pacientes'])

    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.company.staff.index'), 'icon_widget' => 'img/placeholders/icons/staff.png', 'title_widget' => 'Personal'])

@endsection





