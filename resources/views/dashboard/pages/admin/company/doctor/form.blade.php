@extends('dashboard.pages.layout')
  @section('title') 
    @if($doctor->exists) Editar {{$doctor->cc}} @else Nuevo Doctor @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($doctor->exists) Editar Doctor: {{$doctor->name}} @else Nuevo Doctor @endif
    </h1> 
  @endsection 

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos del Doctor</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($doctor, $form_data) !!}
                  {!! Field::text('color', null, ['template' => 'color']) !!}
                  {!! Field::text( 'cc', null, ['placeholder' => 'Cedula', 'template' => 'horizontal']) !!}
                  {!! Field::text( 'first_name', null, ['placeholder' => 'Nombres', 'template' => 'horizontal']) !!}
                  {!! Field::text( 'last_name', null, ['placeholder' => 'Apellidos', 'template' => 'horizontal']) !!}
                  {!! Field::select('specialty_id', $specialties, null, ['data-placeholder' => 'Seleccione una especialidad', 'template' => 'horizontal']) !!}
                  {!! Field::file('photo', null, [ 'template' => 'horizontal']) !!}
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
