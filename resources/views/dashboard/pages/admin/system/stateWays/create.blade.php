@extends('dashboard.pages.layout')
@section('title') 
	Nuevo estado de via
@endsection

@section('dashboard_title') 
  <h1>
    Nuevo estado de via
  </h1> 
@endsection 

@section('dashboard_body') 
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
        <div class="block">
            <div class="block-title">
                <h2>Datos estado de via</h2>
            </div>
            <div class="form-horizontal form-bordered">
              {!! Form::open(['route' => 'admin.system.stateWays.store']) !!}
        		@include('dashboard.pages.admin.system.stateWays.fields')
    		  {!! Form::close() !!}
            </div>
        </div>
    </div>
  </div>
@endsection
