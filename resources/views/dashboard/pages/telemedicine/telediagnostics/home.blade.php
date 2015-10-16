@extends('dashboard.pages.telemedicine.teleconsult.home')
    
@section('title') 
    Telediagnóstico
@endsection

@section('dashboard_title')
    {!! Html::style('assets/css/webrtc.css') !!}
    <h1>
        <i class="fa fa-desktop"></i>
        Telediagnóstico
    </h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('telediagnostic') !!}
@endsection

@section('sidebar_menu')
@endsection



