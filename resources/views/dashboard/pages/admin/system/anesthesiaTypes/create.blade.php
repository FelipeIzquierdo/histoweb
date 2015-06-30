@extends('dashboard.pages.layout')
@section('title') 
	Nuevo tipo anestesia
@endsection

@section('dashboard_title') 
  <h1>
    Nuevo tipo anestesia
  </h1> 
@endsection 

@section('dashboard_body') 
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
        <div class="block">
            <div class="block-title">
                <h2>Datos del tipo anestesia</h2>
            </div>
            <div class="form-horizontal form-bordered">
              {!! Form::open(['route' => 'admin.system.anesthesiaTypes.store']) !!}
              	@include('dashboard.pages.admin.system.anesthesiaTypes.fields')                  
              {!! Form::close() !!}
            </div>
        </div>
    </div>
  </div>
@endsection