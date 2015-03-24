@extends('dashboard.pages.layout')

@section('dashboard_body')
    <div class="col-sm-3">
        <a href="/tools" class="widget">
            <div class="widget-content themed-background-info text-light-op text-center">
                <div class="widget-icon">
                    {!! Html::image('img/placeholders/icons/box.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail']) !!}
                </div>
            </div>
            <div class="widget-content text-dark text-center">
                <strong>Herramientas</strong>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="/surgeries" class="widget">
            <div class="widget-content themed-background-info text-light-op text-center">
                <div class="widget-icon">
                    {!! Html::image('img/placeholders/icons/build.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
                </div>
            </div>
            <div class="widget-content text-dark text-center">
                <strong>Consultorios</strong>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="/doctors" class="widget">
            <div class="widget-content themed-background-info text-light-op text-center">
                <div class="widget-icon">
                    {!! Html::image('img/placeholders/icons/doctor.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
                </div>
            </div>
            <div class="widget-content text-dark text-center">
                <strong>Doctores</strong>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="/specialties" class="widget">
            <div class="widget-content themed-background-info text-light-op text-center">
                <div class="widget-icon">
                    {!! Html::image('img/placeholders/icons/student.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
                </div>
            </div>
            <div class="widget-content text-dark text-center">
                <strong>Especialidades Doctor</strong>
            </div>
        </a>
    </div>

@endsection

@section('dashboard_title')
	Agenda de citas
@endsection

