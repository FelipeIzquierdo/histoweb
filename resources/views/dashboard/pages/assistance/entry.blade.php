@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Paciente: {{ $diary->patient->name }}
        <a id="btn-video" class="btn btn-info" title="Videoconferencia">
                <i class="fa fa-video-camera"></i>
        </a>
    </h1>
@endsection

@section('sidebar_menu')
    @include('dashboard.pages.assistance.menu') 
@endsection

@section('dashboard_body')
    
    {!! Form::open(['route' => ['assistance.entries.history', $diary->id], 'method' => 'POST', 'id' => 'entryForm']) !!}
    
        <div class="block" id="videoconferencing" style="display:none">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Videoconferencia</h2>
            </div>

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

                            <div class="text-content">
                                <h5>Dr. {!! $doctor->name !!}</h5>
                                <h5><small>{!! $doctor->specialty->name !!}</small></h5>
                            </div>

                            <img id="imagen1" width="670" height="500" src="{{ URL::to('img/placeholders/icons/video.png') }}" class="doc-img animate attachment-gallery-post-single wp-post-image" alt="doctor-1"> 

                            <div id="myCamera"> </div>

                        </div>
                    </div>

                    <div class="col-md-offset-3 col-md-8 col-lg-4 text-center doc-item">
                        <div class="common-video animated fadeInUp clearfix ae-animation-fadeInUp">

                            <div class="text-content">
                                <h5 id="name_doc">Dr.</h5>
                                <h5><small></small></h5>
                            </div>

                            <img id="imagen2" width="670" height="500" src="{{ URL::to('img/placeholders/icons/video.png') }}" class="doc-img animate attachment-gallery-post-single wp-post-image" alt="doctor-2"> 

                            <div id="subscribers"> </div>
                        
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Motivos de Consulta</h2>
            </div>
            <div class="form-horizontal form-bordered">
                {!! Field::select('reasons[]', $reasons, null, ['id' => 'reasons', 'data-placeholder' => 'Motivos de consulta', 'template' => 'horizontal', 'multiple' ]) !!}
                {!! Field::text('new_reasons', null, ['template' => 'horizontal', 'class' => 'input-tags']) !!}
                {!! Field::textarea( 'present_illness', null, ['placeholder' => 'Enfermedad actual', 'template' => 'horizontal', 'rows' => '3']) !!}
            </div>
        </div>

        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Antecedentes Personales</h2>
            </div>
            
            <div class="panel-group" id="accordion">
                @foreach($historyTypes as $type)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{!! $type->name_system !!}" class=""> {!! $type->name !!}</a>
                            </h4>
                        </div>
                        <div id="collapse_{!! $type->name_system !!}" class="panel-collapse collapse" style="">
                            <div class="panel-body form-horizontal form-bordered">
                                {!! Field::select($type->name_system . '[]', $type->historyLists(), null, ['id' => $type->name_system, 'data-placeholder' => $type->name, 'template' => 'horizontal', 'multiple' ]) !!}
                                @if($type->news)
                                    {!! Field::text('new_' . $type->name_system, null, ['class' => 'input-tags', 'template' => 'horizontal']) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_sexual_history" class=""> Historia Sexual</a>
                        </h4>
                    </div>
                    <div id="collapse_sexual_history" class="panel-collapse collapse" style="">
                        <div class="panel-body form-horizontal form-bordered">
                            {!! Field::textarea('sexual_history', null, ['template' => 'horizontal']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>  

        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Revisión de Sistemas</h2>
            </div>
            <div class="form-horizontal form-bordered">
                {!! Field::select('system_revisions[]', $system_revisions, null, ['id' => 'system_revisions', 'data-placeholder' => 'Revisiones de sistemas', 'template' => 'horizontal', 'multiple' ]) !!}
                {!! Field::text('new_system_revisions', null, ['template' => 'horizontal', 'class' => 'input-tags']) !!}
            </div>
        </div>

        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Diagnosticos y Procedimientos</h2>
            </div>
            <div class="form-horizontal form-bordered">
                {!! Field::select('procedures[]', $procedures, null, ['id' => 'procedures', 'data-placeholder' => 'Procedimientos', 'template' => 'horizontal', 'multiple' ]) !!}
                {!! Field::select('diseases[]', $diseases, null, ['id' => 'diseases', 'data-placeholder' => 'Enfermedades', 'template' => 'horizontal', 'multiple' ]) !!}
            </div>
        </div>  

        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Plan de Manejo</h2>
            </div>
            <div class="form-horizontal form-bordered">
                {!! Field::textarea('management_plan', null, ['placeholder' => 'Plan de manejo', 'template' => 'horizontal', 'rows' => '3']) !!}
                
                <div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        {!! Form::button('Vista previa', ['class' => 'btn btn-primary', 'type' => 'submit', 'id' => 'submitEntry']) !!}
                    </div>
                </div>
            </div>
        </div>      
    {!! Form::close() !!}

    <!-- Regular Fade -->
    <div id="entryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"><strong>Historia Clinica,</strong> {!! $diary->patient->doc_type_doc !!} - {!! $diary->patient->name !!} </h3>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal form-bordered">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Motivos de consulta</label>
                            <div class="col-md-9">
                                <p id="modal_reasons"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Enfermedad actual</label>
                            <div class="col-md-9">
                                <p id="modal_present_illness"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Antecedentes</label>
                            <div class="col-md-9">
                                <p id="modal_history"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Revisión de sistemas</label>
                            <div class="col-md-9">
                                <p id="modal_system_revisions"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Procedimientos</label>
                            <div class="col-md-9">
                                <p id="modal_procedures"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Diagnosticos</label>
                            <div class="col-md-9">
                                <p id="modal_diseases"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Plan de Manejo</label>
                            <div class="col-md-9">
                                <p id="modal_management_plan"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-effect-ripple btn-warning" data-dismiss="modal" id="edit"> 
                        <i class="fa fa-pencil"></i> Seguir editando
                    </button>
                    <button type="button" class="btn btn-effect-ripple btn-primary" data-dismiss="modal" id="confirm">Confirmar</a></button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Regular Fade -->
    
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
        var name = '{{ $doctor->name }}';
        var invitado = false;
        var audio = new Audio("{{ URL::to('call.mp3') }}");
    </script>
    {!! Html::script('//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js') !!}
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
    {!! Html::script('http://static.opentok.com/webrtc/v2.2/js/opentok.min.js') !!}
    {!! Html::style('css/videoconferencing.css') !!}
    {!! Html::script('assets/js/videoconferencing.js') !!}
@endsection

