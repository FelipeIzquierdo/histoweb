@extends('dashboard.pages.layout')
  @section('title') 
    @if($inventary->exists) Editar {{$inventary->cc}} @else Nuevo inventario @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($inventary->exists) Editar inventario: {{$inventary->name}} @else Nuevo inventario @endif
    </h1> 
  @endsection 

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos del inventario</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($inventary, $form_data) !!}
                  {!! Field::select( 'medicament_id', $medicament, null, ['data-placeholder' => 'Medicamento', 'template' => 'horizontal']) !!}
                  {!! Field::select( 'presentation_id', $presentation, null, ['data-placeholder' => 'Presentación', 'template' => 'horizontal']) !!}
                  {!! Field::number( 'concentration', null , ['min' => '0', 'template' => 'horizontal']) !!}
                  {!! Field::select( 'measure_id', $measure, null, ['data-placeholder' => 'Medida', 'template' => 'horizontal']) !!}
                  {!! Field::number( 'quantity', null , ['min' => '0', 'template' => 'horizontal']) !!}
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
