@extends('dashboard.pages.layout')
@section('title') 
	Editar  via de entrada
@endsection

@section('dashboard_title') 
  <h1>
    Editar via de entrada
  </h1> 
@endsection 

@section('dashboard_body') 
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
        <div class="block">
            <div class="block-title">
                <h2>Datos Via de Entrada</h2>
            </div>
            <div class="form-horizontal form-bordered">
            	{!! Form::model($wayEntry, ['route' => ['admin.system.wayEntries.update', $wayEntry->id], 'method' => 'patch']) !!}
    				@include('dashboard.pages.admin.system.wayEntries.fields')
    			{!! Form::close() !!}
            </div>
        </div>
    </div>
  </div>
@endsection
