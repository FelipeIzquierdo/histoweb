@extends('dashboard.pages.layout')
  @section('title') 
    @if($schedule->exists) Editar @else Agregar @endif Horarios
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($schedule->exists) Editar @else Agregar @endif Horarios
    </h1> 
  @endsection 

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos de la Horarios</h2>
              </div>
              <div class="form-horizontal form-bordered">               
                {!! Form::model($schedule, $form_data) !!}
                    {!! Field::select('doctor_id', $doctors, null, ['data-placeholder' => 'Seleccione un Doctor', 'template' => 'horizontal']) !!}
                    {!! Field::dateRange('start_date', 'end_date', null, null, ['placeholder' => 'Desde'], ['placeholder' => 'Hasta']) !!}
                    {!! Field::select('days[]', $days, $schedule->days_id, ['data-placeholder' => 'Seleccione los Días', 'template' => 'horizontal', 'multiple']) !!}
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