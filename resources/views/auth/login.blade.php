@extends ('auth.layout')
    
    @section ('title') .: HistoWeb | Login :. @endsection
    
    @section('auth_title')
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <i class="fa fa-cube"></i> <strong>HistoWeb</strong>
        </h1>
    @endsection

    @section('auth_buttons')
        <a href="{{url('password/email')}}" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Olvidaste tu contraseña?"><i class="fa fa-exclamation-circle"></i></a>
    @endsection

    @section('auth_header')
        <h2>Iniciar Sesión</h2>
    @endsection

    @section('auth_form')
        {!! Form::open(array('url' => 'auth/login', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'form-login')) !!}
            <div class="form-group">
                <div class="col-xs-12">
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-8">
                    <label class="csscheckbox csscheckbox-primary">
                        <input type="checkbox" id="login-remember-me" name="remember" value="true">
                        <span></span>
                    </label>
                    Recordarme
                </div>
                <div class="col-xs-4 text-right">
                    <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Iniciar</button>
                </div>
            </div>
        {!! Form::close() !!}
    @endsection
