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
            <div class="form-horizontal form-bordered home-video clearfix center-all">
                
                <div class="row">
                    <div class="col-md-offset-2 col-md-7 col-xs-6 doc-itemx">
                            <button id="connectLink" type="button" class="btn btn-effect-ripple btn-success btn-growl" data-growl="success" onclick="javascript:connect()" ><i class="fa fa-fw fa-user-md"></i> Iniciar </button>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-8 col-lg-4 text-center doc-item">

                        <div class="common-video animated fadeInUp clearfix ae-animation-fadeInUp">

                            <div id="myCamera">
                                <img id="imagen1" width="670" height="500" src="{{ URL::to('img/placeholders/icons/video.png') }}" class="doc-img animate attachment-gallery-post-single wp-post-image" alt="doctor-1"> 
                            </div>

                            <div class="text-content">
                                <h5> Invitado </h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-offset-3 col-md-8 col-lg-4 text-center doc-item">
                        <div class="common-video animated fadeInUp clearfix ae-animation-fadeInUp">

                            <div id="subscribers">
                                <img id="imagen2" width="670" height="500" src="{{ URL::to('img/placeholders/icons/video.png') }}" class="doc-img animate attachment-gallery-post-single wp-post-image" alt="doctor-2"> 
                            </div>
                            

                            <div class="text-content">
                                <h5 id="name_doc"></h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="acceptCallBox">
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

	        <button id="callAcceptButton" type="button" class="btn btn-effect-ripple btn-success" style="margin-left :30px;">Contestar</button>
	        <button id="callRejectButton"type="button" class="btn btn-effect-ripple btn-danger">Rechazar</button>
        </div>

	@endsection

@section('js_extra')
    <script type="text/javascript">
        var apiKey = '{{ $api_key }}'; 
        var sessionId = '2_MX40NTMwNTQ2Mn5-MTQzOTE0MjA2Mzk0N35HUkdteEdlcVhGSFMrMkdZQ2kwckM2SWp-UH4'; 
        var token = 'T1==cGFydG5lcl9pZD00NTMwNTQ2MiZzaWc9M2FmYjlmYTJjZTdlN2UyMzg1NzhmM2MxZWIwNjE1YmIwNWQyNWExNTpzZXNzaW9uX2lkPTJfTVg0ME5UTXdOVFEyTW41LU1UUXpPVEUwTWpBMk16azBOMzVIVWtkdGVFZGxjVmhHU0ZNck1rZFpRMmt3Y2tNMlNXcC1VSDQmY3JlYXRlX3RpbWU9MTQzOTE0MjA2NCZyb2xlPW1vZGVyYXRvciZub25jZT0xNDM5MTQyMDY0LjAyNzEzNTk4NTI4OTcmZXhwaXJlX3RpbWU9MTQzOTc0Njg2NCZjb25uZWN0aW9uX2RhdGE9bmFtZSUzREZlbGlwZQ==';  
        var name = 'Invitado';
        var invitado = true;
        var audio = new Audio("{{ URL::to('call.mp3') }}");
    </script>
    {!! Html::script('//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js') !!}
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
    {!! Html::script('http://static.opentok.com/webrtc/v2.2/js/opentok.min.js') !!}
    {!! Html::style('css/videoconferencing.css') !!}
    {!! Html::script('assets/js/videoconferencing.js') !!}
@endsection