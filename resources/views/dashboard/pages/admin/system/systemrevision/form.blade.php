@extends('dashboard.pages.layout')
  @section('title') 
    @if($revision->exists) Editar {{$revision->id}} @else Nueva revisión de sistemas @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($revision->exists) Editar revisión de sistemas: {{$revision->name}} @else Nueva revisión de sistemas @endif
    </h1> 
  @endsection 

  @section('breadcrumbs')
    {!! Breadcrumbs::render('system_revision.create',$revision) !!}
  @endsection

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos de revisión de sistemas</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($revision, $form_data) !!}
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
