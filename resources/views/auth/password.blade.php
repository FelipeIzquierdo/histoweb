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
        <form id="form-reminder" action="password/email" method="post" class="form-horizontal">
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" id="reminder-email" name="reminder-email" class="form-control" placeholder="Ingresa tu email..">
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Enviar</button>
                </div>
            </div>
        </form>
    @endsection
    </div>
@endsection
