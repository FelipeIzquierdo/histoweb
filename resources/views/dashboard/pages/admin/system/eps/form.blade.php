@extends('dashboard.pages.layout')
  @section('title') 
    @if($eps->exists) Editar {{$eps->name}} @else Nueva Eps @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($eps->exists) Editar {{$eps->name}} @else Nueva Eps @endif
    </h1> 
  @endsection 

  @section('breadcrumbs')
    {!! Breadcrumbs::render('eps.create',$eps) !!}
  @endsection

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos de la Eps</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($eps, $form_data) !!}
                  {!! Field::text( 'name', null, ['placeholder' => 'Nombre Eps', 'template' => 'horizontal']) !!}
                  {!! Field::text( 'code', null, ['placeholder' => 'Codigo', 'template' => 'horizontal']) !!}           <div class="form-group form-actions">
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
