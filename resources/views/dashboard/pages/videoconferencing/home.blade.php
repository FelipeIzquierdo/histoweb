@extends('dashboard.pages.layout')
    
@section('title') 
    Videoconferencia
@endsection

@section('meta_extra')
    <meta name="_token" content="{{ csrf_token() }}"/>
@endsection

@section('dashboard_title')
    {!! Html::style('assets/css/webrtc.css') !!}
    <h1>
        <i class="fa fa-desktop"></i>
        Videoconferencia
    </h1>
@endsection

@section('breadcrumbs')
    
@endsection
    
@section('dashboard_body')

    {!! Html::script('//cdn.webrtc-experiment.com/firebase.js') !!}
    {!! Html::script('//cdn.webrtc-experiment.com/RTCMultiConnection.js') !!}
    {!! Html::script('//www.webrtc-experiment.com/RecordRTC.js') !!}
    
<div class="block" id="videoconferencing">

     <section class="experiment">
            <table style="width: 100%;" id="rooms-list"></table>
    </section>

    <div class="row">
        <div class="col-sm-4 col-lg-push-4">
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
        <div id="col-home" class="col-lg-8 col-lg-push-2">

            <div id="invited_widget" class="widget">
                <div class="widget-content themed-background-flat text-left clearfix">
                    <a href="javascript:void(0)" class="pull-right">
                        <img src="{{ URL::to('img/placeholders/icons/user.png') }}" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
                    </a>
                    <h3 class="widget-heading text-light"> {{ Auth::user()->patients->name }} <br/> </h3>
                </div>
            </div>

            <div id="video-home" style="display:none;" > </div>

        </div>
    </div>

    <div class="row">
        <div id="col-visit" class="col-lg-8 col-lg-push-2">

                <div class="streams">
                    <div id="remotes"></div>
                </div>

            <div id="video-visit" style="display:none;" ></div>

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
                        <a onclick="hola()" class="btn btn-effect-ripple btn-success"><i class="fa fa-share"></i> Disponible </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <audio id="callingSignal" loop>
        <source src="{{  URL::to('assets/js/plugins/simplewebrtc/audio/calling.ogg') }}"></source>
        <source src="{{  URL::to('assets/js/plugins/simplewebrtc/audio/calling.mp3') }}"></source>
    </audio>

    <audio id="endCallSignal">
        <source src="{{  URL::to('assets/js/plugins/simplewebrtc/audio/end_of_call.ogg') }}"></source>
        <source src="{{  URL::to('assets/js/plugins/simplewebrtc/audio/end_of_call.mp3') }}"></source>
    </audio>

    <audio id="ringtoneSignal" loop>
        <source src="{{  URL::to('assets/js/plugins/simplewebrtc/audio/ringtone.ogg') }}"></source>
        <source src="{{  URL::to('assets/js/plugins/simplewebrtc/audio/ringtone.mp3') }}"></source>
    </audio>

</div>

@endsection

@section('js_extra')

    <script type="text/javascript">
        var name = '{{ Auth::user()->patients->name }}'; 
        var room = '{{ Auth::user()->patients->id }}';
        var number_videos = 0;
    </script>
    
    {!! Html::script('assets/js/pages/webrtc.js') !!}
    {!! Html::script('//cdn.webrtc-experiment.com/commits.js') !!}    
    {!! Html::script('https://cdn.rawgit.com/webrtc/adapter/master/adapter.js') !!}
    {!! Html::script('assets/js/plugins/recordrtc/recordrtc.js') !!}
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
    {!! Html::script('assets/js/plugins/simplewebrtc/simplewebrtc.bundle.js') !!}
    <!-- {!! Html::script('assets/js/pages/telemedicine.js') !!} 
    <script src="https://cdn.webrtc-experiment.com/commits.js" async></script>-->

@endsection




