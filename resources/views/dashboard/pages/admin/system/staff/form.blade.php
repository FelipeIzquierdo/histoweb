@extends('dashboard.pages.layout')
  @section('title') 
    @if($staff->exists) Editar {{$staff->code}} @else Nuevo Personal @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($staff->exists) Editar Personal: {{$staff->name}} @else Nuevo Personal @endif
    </h1> 
  @endsection 

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos del tipo de cita</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($staff, $form_data) !!}
                  {!! Field::text('name', null, ['placeholder' => 'Nombre', 'template' => 'horizontal']) !!}
                  {!! Field::text('code', null, ['placeholder' => 'Codigo', 'template' => 'horizontal']) !!}
                  {!! Field::text('description', null, ['placeholder' => 'Descripción', 'template' => 'horizontal']) !!}
                  {!! Field::select('professions[]', $professions, $staff->professions_id, ['data-placeholder' => 'Seleccione la(s) profesione(s)', 'template' => 'horizontal', 'multiple']) !!}

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

