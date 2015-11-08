@extends('dashboard.pages.layout')
  @section('title') 
    @if($concentration->exists) Editar {{$concentration->cc}} @else Nuevo concentración @endif
  @endsection

  @section('breadcrumbs')
    {!! Breadcrumbs::render('concentration.create',$concentration) !!}
  @endsection

  @section('dashboard_title') 
    <h1>
      @if($concentration->exists) Editar concentración: {{$concentration->name}} @else Nuevo concentración @endif
    </h1> 
  @endsection 

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos de la concentración</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($concentration, $form_data) !!}
                  {!! Field::select( 'generic_medication_id', $generic_medications, null, ['data-placeholder' => 'Medicamento genérico', 'template' => 'horizontal']) !!}
                  {!! Field::select( 'presentation_id', $presentations, null, ['data-placeholder' => 'Presentación', 'template' => 'horizontal']) !!}
                  {!! Field::select( 'unit_id', $units, null, ['id' => 'unit_id','data-placeholder' => 'Unidad', 'template' => 'horizontal']) !!}
                  {!! Field::number( 'unit_amount', null , ['min' => '0', 'template' => 'horizontal']) !!}
                  {!! Field::select( 'diluent_id', $diluents, null, ['data-placeholder' => 'Diluyente', 'template' => 'horizontal']) !!}
                  {!! Field::number( 'diluent_amount', null , ['min' => '0', 'template' => 'horizontal']) !!}
                  
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
