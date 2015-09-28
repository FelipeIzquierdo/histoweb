@extends('dashboard.pages.layout')
	@section('title') 
	    Videoconferencia
	@endsection

    @section('meta_extra')
        <meta name="_token" content="{{ csrf_token() }}"/>
    @endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-desktop"></i>
			Videoconferencia
		</h1>
	{!! Html::style('assets/css/simplewebrtc.css') !!}
	@endsection

	@section('breadcrumbs')
		
	@endsection
	
	@section('dashboard_body')

<div class="block" id="videoconferencing">

    <div class="row">
        <div class="col-sm-4 col-lg-push-4">
            <a href="javascript:void(0)" class="widget text-center">
                <div id="hangupButton" class="widget-content themed-background-danger text-light-op text-center">
                    <strong> Colgar </strong> 
                </div>
                 <div id="init" class="widget-content themed-background-success text-light-op text-center" style="display:none;">
                    <strong> Iniciar </strong> 
                </div>
                <div id="save_video" class="widget-content themed-background-success text-light-op text-center">
                    <strong> Guardar </strong> 
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-push-2">

                <div class="streams">
                    <div id="remotes"></div>
                </div>

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
                        <a href="javascript:void(0)" class="btn btn-effect-ripple btn-success"><i class="fa fa-share"></i> Disponible </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-lg-push-4">
                <h2 class="widget-heading text-dark"><strong>{{ Auth::user()->patients->name }}</strong></h2>
                <div id="invited_widget" class="col-lg-12" style="display:none;">
                    <video id="localVideo"></video>
                    <div class="mediacall-controls l-flexbox l-flexbox_flexcenter">
                        <button class="btn_mediacall btn_camera_off" data-action="mute"><img class="btn-icon_mediacall" src="{{  URL::to('assets/js/plugins/simplewebrtc/images/icon-camera-off.png') }}" alt="camera"></button>
                        <button class="btn_mediacall btn_mic_off" data-action="mute"><img class="btn-icon_mediacall" src="{{  URL::to('assets/js/plugins/simplewebrtc/images/icon-mic-off.png') }}" alt="mic"></button>
                    </div>
                </div>
        </div>
    </div>

    <div class="videoContainer"></div>

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

     <div id="container" style="padding:1em 2em;"></div>

    </div>
</div>

	@endsection

@section('js_extra')
    <script type="text/javascript">
        var room = '{{ Auth::user()->patients->id }}';
    </script>

    {!! Html::script('https://cdn.rawgit.com/webrtc/adapter/master/adapter.js') !!}
    {!! Html::script('assets/js/plugins/recordrtc/recordrtc.js') !!}
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
    {!! Html::script('assets/js/plugins/simplewebrtc/simplewebrtc.bundle.js') !!}
    {!! Html::script('assets/js/pages/telemedicine.js') !!}
    <script src="https://cdn.webrtc-experiment.com/commits.js" async></script>
    

@endsection
