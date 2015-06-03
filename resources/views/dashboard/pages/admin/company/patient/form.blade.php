@extends('dashboard.pages.layout')
  @section('title') 
    @if($patient->exists) Editar {{$patient->cc}} @else Nuevo Paciente @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($patient->exists) Editar Paciente: {{$patient->name}} @else Nuevo Paciente @endif
    </h1> 
  @endsection 

  @section('breadcrumbs')
    {!! Breadcrumbs::render('patients.create', $patient) !!}
  @endsection

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos del Paciente</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($patient, $form_data) !!}
                  {!! Field::select( 'doc_type_id', $doc_types, null, ['data-placeholder' => 'Tipo de documento', 'template' => 'horizontal']) !!}
                  {!! Field::text( 'doc', null, ['placeholder' => 'Documento', 'template' => 'horizontal']) !!}
                  {!! Field::select( 'sex', $genders, null, ['data-placeholder' => 'Género', 'template' => 'horizontal']) !!}
                  {!! Field::text( 'first_name', null, ['placeholder' => 'Nombres', 'template' => 'horizontal']) !!}
                  {!! Field::text( 'last_name', null, ['placeholder' => 'Apellidos', 'template' => 'horizontal']) !!}
                  {!! Field::text( 'date_birth', null, ['placeholder' => 'Fecha de nacimiento', 'class' => 'input-datepicker', 'template' => 'horizontal', 'data-date-format' => 'yyyy-mm-dd']) !!}
                  {!! Field::text( 'tel', null, ['placeholder' => 'Télefono', 'template' => 'horizontal']) !!}
                  {!! Field::email( 'email', null, ['placeholder' => 'Correo Electrónico', 'template' => 'horizontal']) !!}
                  {!! Field::select('occupation_id', $occupations, null, ['data-placeholder' => 'Seleccione una ocupación', 'template' => 'horizontal']) !!}
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
