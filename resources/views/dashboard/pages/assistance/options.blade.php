@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Paciente: {{ $entry->diary->patient->name }}</h1>
@endsection

@section('sidebar_menu')
    @include('dashboard.pages.assistance.menu') 
@endsection

@section('dashboard_body')
    

@endsection

@section('js_extra')
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
@endsection