@extends('dashboard.pages.layout')
  @section('title') 
    @if($history->exists) Editar {{$history->cc}} @else Nuevo antecedente @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($history->exists) Editar antecedente: {{$history->name}} @else Nuevo antecedente @endif
    </h1> 
  @endsection 

  @section('breadcrumbs')
    {!! Breadcrumbs::render('history.create',$history) !!}
  @endsection

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos del antecedente</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($history, $form_data) !!}
                  {!! Field::select( 'type', $history_types, null, ['data-placeholder' => 'Tipo de antecedente', 'template' => 'horizontal']) !!}
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
