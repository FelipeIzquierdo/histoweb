@extends('dashboard.pages.layout')
  @section('title') 
    @if($surgery->exists) Editar {{$surgery->name}} @else Nuevo Consultorio @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($surgery->exists) Editar {{$surgery->name}} @else Nuevo Consultorio @endif
    </h1> 
  @endsection 

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos del Consultorio</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($surgery, $form_data) !!} 

                  {!! Field::text( 'name', null, ['placeholder' => 'Ej Consultorio 1', 'template' => 'horizontal']) !!}

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
