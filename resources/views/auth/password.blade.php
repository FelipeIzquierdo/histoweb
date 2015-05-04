@extends ('auth.layout')
    @section('title')
        Recuperar Contraseña
    @endsection

    @section('auth_title')
        <i class="fa fa-cube"></i> <strong>Recuperar Contraseña</strong>
    @endsection

    @section('auth_buttons')
        <a href="{{url('auth/login')}}" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Volver al Inicio de Sesión"><i class="fa fa-user"></i></a>
    @endsection

    @section('auth_header')
        <h2>Recuerar Contraseña</h2>
    @endsection

    @section('auth_form')

        {!! Form::open(array('url' => 'auth/login', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'form-reminder')) !!}
            <div class="form-group">
                <div class="col-xs-12">
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingresa tu email..']) !!}
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Enviar</button>
                </div>
            </div>
        {!! Form::close() !!}
    @endsection
    </div>
@endsection
