@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Consultorio</h1>
@endsection

@section('dashboard_body')

    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('tools.index'), 'icon_widget' => 'img/placeholders/icons/box.png', 'title_widget' => 'Herramientas'])
    
    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('surgeries.index'), 'icon_widget' => 'img/placeholders/icons/build.png', 'title_widget' => 'Consultorios'])

    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('doctors.index'), 'icon_widget' => 'img/placeholders/icons/doctor.png', 'title_widget' => 'Doctores'])

    @include('dashboard.includes.bootstrap.widget', ['url_widget' => route('specialties.index'), 'icon_widget' => 'img/placeholders/icons/student.png', 'title_widget' => 'Especialidades'])

@endsection



