@extends('dashboard.pages.layout')
  @section('title') 
    @if($procedure->exists) Editar {{$procedure->id}} @else Nuevo Procedimiento @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($procedure->exists) Editar Procedimiento: {{$procedure->name}} @else Nuevo Procedimiento @endif
    </h1> 
  @endsection 

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos de Procedimiento</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($procedure, $form_data) !!}
                  {!! Field::text( 'cod', null, ['placeholder' => 'Código', 'template' => 'horizontal']) !!}
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
