@extends('dashboard.pages.layout')
  @section('title') 
    @if($availability->exists) Editar @else Agregar @endif Disponibilidad
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($availability->exists) Editar @else Agregar @endif Disponibilidad
    </h1> 
  @endsection 

  @section('breadcrumbs')
    {!! Breadcrumbs::render('doctors.availabilities.create', $doctor) !!}
  @endsection

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos de la disponibilidad</h2>
              </div>
              <div class="form-horizontal form-bordered">               
                {!! Form::model($availability, $form_data) !!}  
                  @if($doctor->telemedicine)
                    {!! Field::select('type', $types, null, ['data-placeholder' => 'Seleccione el tipo de Disponibilidad', 'template' => 'horizontal']) !!}
                  @endif
                  {!! Field::dateRange('start_date', 'end_date', null, null, ['placeholder' => 'Desde'], ['placeholder' => 'Hasta']) !!}
                  {!! Field::select('days[]', $days, $availability->days_id, ['data-placeholder' => 'Seleccione los Días', 'template' => 'horizontal', 'multiple']) !!}
                  {!! Field::time('start_time', null) !!}
                  {!! Field::time('end_time', null) !!}
                  
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