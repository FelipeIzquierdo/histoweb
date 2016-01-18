@extends('dashboard.pages.layout')
    
@section('title') 
    Teleconsulta
@endsection

@section('meta_extra')
    <meta name="_token" content="{{ csrf_token() }}"/>
@endsection

@section('dashboard_title')
    {!! Html::style('assets/css/webrtc.css') !!}
    <h1>
        <i class="fa fa-desktop"></i>
        Teleconsulta    
    </h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('teleconsult') !!}
@endsection

@section('sidebar_menu')
    @include('dashboard.pages.telemedicine.menu') 
@endsection

@section('dashboard_body')

{!! Html::script('//cdn.webrtc-experiment.com/firebase.js') !!}
{!! Html::script('//cdn.webrtc-experiment.com/RTCMultiConnection.js') !!}
{!! Html::script('//www.webrtc-experiment.com/RecordRTC.js') !!}
    
<div class="block">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xs-push-0 col-sm-push-0 col-md-push-0 col-lg-push-1">
            <a href="javascript:void(0)" class="widget text-center">
                <div id="leave-conference" class="widget-content themed-background-danger text-light-op text-center" style="display:none;">
                    <strong> Colgar </strong> 
                </div>
                 <div id="init-conference" class="widget-content themed-background-success text-light-op text-center">
                    <strong> Iniciar </strong> 
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xs-push-0 col-sm-push-0 col-md-push-0 col-lg-push-1">

            <div id="invited_widget" class="widget">
                <div class="widget-content themed-background-flat text-left clearfix">
                    <a href="javascript:void(0)" class="pull-right">
                        <img src="{{ URL::to('img/placeholders/icons/user.png') }}" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
                    </a>
                    <h3 class="widget-heading text-light"> {{ Auth::user()->doctors->name }} <br/> </h3>
                </div>
            </div>

        </div>
    </div>

    <div class="row">   
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xs-push-0 col-sm-push-0 col-md-push-0 col-lg-push-1">

            <div id="sala" > </div>

            <div id="doctor_widget" class="widget">
                <div class="widget-content themed-background-flat text-left clearfix">
                    <a href="javascript:void(0)" class="pull-right">
                        <img src="{{ URL::to('img/placeholders/icons/video.png') }}" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
                    </a>
                    <h3 class="widget-heading text-light"> Doctor <br/> </h3>
                    <h4 class="widget-heading text-light-op">Especialista</h4>
                </div>
                <div class="widget-content themed-background-muted text-center">
                    <div class="btn-group">
                        <a class="btn btn-effect-ripple btn-success"><i class="fa fa-share"></i> Disponible </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js_extra')

    <script type="text/javascript">
        var name = '{{ Auth::user()->doctors->name }}'; 
        var room = 'teleconsult';
        var image_record = "{{ URL::to('img/placeholders/icons/record.png') }}";
        var number_videos = 0;
    </script>
    
    {!! Html::script('assets/js/pages/teleconsult.js') !!}
    {!! Html::script('assets/js/pages/webrtc.js') !!}
    {!! Html::script('//cdn.webrtc-experiment.com/commits.js') !!}    

@endsection




