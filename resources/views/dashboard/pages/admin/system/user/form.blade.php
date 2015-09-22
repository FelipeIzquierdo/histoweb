@extends('dashboard.pages.layout')
  @section('title') 
    @if($user->exists) Editar {{$user->id}} @else Nuevo Usuario @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($user->exists) Editar Usuario: {{$user->name}} @else Nuevo Usuario @endif
    </h1> 
  @endsection 

  @section('breadcrumbs')
    {!! Breadcrumbs::render('users.create',$user) !!}
  @endsection

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <div class="block">
              <div class="block-title">
                  <h2>Datos del Usuario</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($user, $form_data) !!}
                  
                  {!! Field::text( 'name', null, ['placeholder' => 'Nombres', 'template' => 'horizontal']) !!}
                  {!! Field::text( 'email', null, ['placeholder' => 'Correo electrónico', 'template' => 'horizontal']) !!}
                  {!! Field::password('password', array('class' => 'form-control', 'template' => 'horizontal')) !!}
                  {!! Field::password('repeat_password', array('class' => 'form-control', 'template' => 'horizontal')) !!}
                  {!! Field::select( 'role_id', $roles, null, ['data-placeholder' => 'Rol', 'template' => 'horizontal']) !!}

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
