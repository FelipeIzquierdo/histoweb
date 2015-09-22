@extends('dashboard.pages.layout')
	@section('title') 
	    Videoconferencia
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
    <!--
    <div class="row">
        <div class="col-sm-4 col-lg-push-4">
            <a href="javascript:void(0)" class="widget text-center">
                <div class="widget-content themed-background-success text-light-op text-center">
                    <strong> Conectar </strong> 
                </div>
            </a>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="widget">
                        <div class="widget-image widget-image-xs">
                            <img src="img/placeholders/photos/photo18@2x.jpg" alt="image">
                            <div class="widget-image-content">
                                <h2 class="widget-heading text-light"><strong>{{ Auth::user()->patients->name }}</strong></h2>
                                <h3 class="widget-heading text-light-op h4"> Invitado </h3>
                            </div>
                            <i class="fa fa-user"></i>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-lg-push-4">
            <div class="widget">
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
        -->
    <button id="hangupButton">Colgar</button>


    <div class="streams">

        <div class="localControls">

          <span id="callerName"></span><br>

          <video id="localVideo"></video>

          <div class="mediacall-controls l-flexbox l-flexbox_flexcenter">
            <button class="btn_mediacall btn_camera_off" data-action="mute"><img class="btn-icon_mediacall" src="{{  URL::to('assets/js/plugins/simplewebrtc/images/icon-camera-off.png') }}" alt="camera"></button>
            <button class="btn_mediacall btn_mic_off" data-action="mute"><img class="btn-icon_mediacall" src="{{  URL::to('assets/js/plugins/simplewebrtc/images/icon-mic-off.png') }}" alt="mic"></button>
          </div>
        </div>

        <div class="remoteControls">
          <span id="calleeName"></span><br>
          <div id="remotes"></div>
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


    </div>
</div>

	@endsection

@section('js_extra')
    <script type="text/javascript">
        var session_id = '{{ Auth::user()->patients->id }}';
        var audio_boolean = true;
        var audio = new Audio("{{ URL::to('call.mp3') }}");
    </script>
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
    {!! Html::script('assets/js/plugins/simplewebrtc/simplewebrtc.bundle.js') !!}
    {!! Html::script('assets/js/pages/telemedicine.js') !!}

@endsection
