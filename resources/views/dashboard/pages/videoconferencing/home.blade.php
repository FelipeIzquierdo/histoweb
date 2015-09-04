@extends('dashboard.pages.layout')
	@section('title') 
	    Videoconferencia
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-desktop"></i>
			Videoconferencia
		</h1>
	@endsection

	@section('breadcrumbs')
		
	@endsection
	
	@section('dashboard_body')

        <div class="block" id="videoconferencing">

            <div class="row">
                <div class="col-md-offset-5 col-md-7 col-xs-6 doc-itemx">
                        <button id="connectLink" type="button" class="btn btn-effect-ripple btn-success btn-growl" onclick="javascript:connect();" ><i class="fa fa-fw fa-user-md"></i> Iniciar </button>
                        <button id="disconnectLink" type="button" class="btn btn-effect-ripple btn-danger btn-growl" onclick="javascript:disconnect();" style="display : none;" ><i class="fa fa-fw fa-user-md"></i> Colgar </button>
                </div>
            </div>

            <div class="form-horizontal form-bordered home-video clearfix center-all">
                <div class="row">

                    <div class="col-md-8 col-lg-4 text-center doc-item">

                        <div class="common-video animated fadeInUp clearfix ae-animation-fadeInUp">

                            <img id="imagen1" src="{{ URL::to('img/placeholders/icons/video.png') }}" class="img-responsive center-all" alt="doctor-1"> 

                            <div class="text-content">
                                <h5> {{ Auth::user()->name }} </h5>
                            </div>

                            <div id="myCamera"> </div>
                        </div>
                    </div>

                    <div class="col-md-offset-3 col-md-8 col-lg-4 text-center doc-item">
                        <div class="common-video animated fadeInUp clearfix ae-animation-fadeInUp">

                            <img id="imagen2" src="{{ URL::to('img/placeholders/icons/video.png') }}" class="img-responsive center-all" alt="doctor-2"> 

                            <div class="text-content">
                                <h5 id="name_doc"></h5>
                            </div>

                            <div id="subscribers"> </div>
                        
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <!-- Regular Fade -->
    <div id="VideoModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="block">

                    <div class="block-title">
                        <h2>Videoconferencia</h2>
                    </div>

                    <div class="list-group">
                        <a class="list-group-item active">
                            <span class="badge"><i class="fa fa-fw fa-user"></i></span>
                            <h4 class="list-group-item-heading"><strong>Usuarios conectados</strong></h4>
                            <p class="list-group-item-text">Histoweb</p>
                        </a>

                        <div class="input-group c-search">
                            <input type="text" class="form-control" id="contact-list-search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="fa fa-search"></span></button>
                            </span>
                        </div>
                    </div>
                    
                    <ul class="list-group" id="contact-list">
                        <div id="onlineusers"> </div>

                        <div id="acceptCallBox" style ="display : none;">

                             <div class="list-group">
                                <a href="javascript:void(0)" class="list-group-item active">
                                    <span class="badge fa fa-phone" style="float : right;"></span>
                                    <h4 class="list-group-item-heading"><strong>Llamando</strong></h4>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item">
                                    <span class="fa fa-fw fa-user-md" style="float : right;"></span>
                                    <h4 id="acceptCallLabel" class="list-group-item-heading"> </h4>
                                </a>
                            </div>

                            <button id="callAcceptButton" type="button" class="btn btn-effect-ripple btn-success">Contestar</button>
                            <button id="callRejectButton"type="button" class="btn btn-effect-ripple btn-danger">Rechazar</button>
                        </div>

                        <div id="calling" style ="display : none;">
                            <div class="col-lg-12">
                              <p>
                                <a href="#" class="btn btn-sq-lg">
                                  <i class="fa fa-spinner fa-2x fa-spin text-success fa-5x"></i><br/>
                                  Llamando
                                </a>
                              </p>
                            </div>
                        </div>

                    </ul>

                    <div class="modal-footer">
                        <button id="videoexit" type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal"> 
                            <i class="fa fa-pencil"></i> Salir
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END Regular Fade -->

	@endsection

@section('js_extra')
    <script type="text/javascript">
        var apiKey = '{{ $api_key }}'; 
        var sessionId = '{{ $session_id }}'; 
        var token = '{{ $token }}';  
        var name = '{{ Auth::user()->name }}';
        var invitado = true;
        var audio = new Audio("{{ URL::to('call.mp3') }}");
    </script>
    {!! Html::script('//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js') !!}
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
    {!! Html::script('http://static.opentok.com/webrtc/v2.2/js/opentok.min.js') !!}
    {!! Html::style('css/videoconferencing.css') !!}
    {!! Html::script('assets/js/videoconferencing.js') !!}
@endsection