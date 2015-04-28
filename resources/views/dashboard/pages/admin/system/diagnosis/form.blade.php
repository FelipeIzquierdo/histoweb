@extends('dashboard.pages.layout')
  @section('title') 
    @if($diagnosis->exists) Editar {{$diagnosis->id}} @else Nuevo Diagnóstico @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($diagnosis->exists) Editar Diagnóstico: {{$diagnosis->name}} @else Nuevo Diagnóstico @endif
    </h1> 
  @endsection 

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos de Diagnóstico</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($diagnosis, $form_data) !!}
                  {!! Field::text( 'name', null, ['placeholder' => 'Nombre', 'template' => 'horizontal']) !!}
                  <div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
                    </div>
                  </div>
                {!! Form::close() !!}
              </div>  
          </div>
      </div>
    </div>
  @endsection