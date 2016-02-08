@extends('dashboard.pages.layout')

@section('dashboard_title')
    {!! Html::style('assets/css/webrtc.css') !!}
    <h1>Paciente: {{ $diary->patient->name }}
    </h1>
@endsection

@section('meta_extra')
    <meta name="_token" content="{{ csrf_token() }}"/>
@endsection

@section('sidebar_menu')
    @include('dashboard.pages.assistance.menu') 
    @include('dashboard.pages.telemedicine.menu') 
@endsection

@section('sidebar2')
    @include('dashboard.includes.sidebar_telemedicine')
@endsection

@section('dashboard_body')
    
     {!! Form::open(['route' => ['assistance.entries.history', $diary->id], 'method' => 'POST', 'id' => 'entryForm']) !!} 
    
        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Motivos de Consulta</h2>
            </div>
            <div class="form-horizontal form-bordered">
                {!! Field::select('reasons', $reasons, null, ['id' => 'reasons', 'data-placeholder' => 'Motivos de consulta', 'template' => 'horizontalmodal', 'multiple' ]) !!}
                {!! Field::text('new_reasons', null, ['id' => 'new_reasons', 'template' => 'horizontalmodal', 'class' => 'input-tags']) !!}
                {!! Field::textarea( 'present_illness', null, ['id' => 'present_illness', 'placeholder' => 'Enfermedad actual', 'template' => 'horizontalmodal', 'rows' => '3']) !!}
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
                                    {!! Field::text('new_' . $type->name_system, null, ['class' => 'input-tags', 'template' => 'horizontalmodal']) !!}
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
                            {!! Field::textarea('sexual_history', null, ['id' => 'sexual_history', 'template' => 'horizontalmodal']) !!}
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
                {!! Field::select('system_revisions', $system_revisions, null, ['id' => 'system_revisions', 'data-placeholder' => 'Revisiones de sistemas', 'template' => 'horizontalmodal', 'multiple' ]) !!}
                {!! Field::text('new_system_revisions', null, ['id' => 'new_system_revisions', 'template' => 'horizontalmodal', 'class' => 'input-tags']) !!}
            </div>
        </div>

        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Diagnosticos y Procedimientos</h2>
            </div>
            <div class="form-horizontal form-bordered">
                {!! Field::select('procedures', $procedures, null, ['id' => 'procedures', 'data-placeholder' => 'Procedimientos', 'template' => 'horizontalmodal', 'multiple' ]) !!}
                {!! Field::select('diseases', $diseases, null, ['id' => 'diseases', 'data-placeholder' => 'Enfermedades', 'template' => 'horizontalmodal', 'multiple' ]) !!}
            </div>
        </div>  

        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Plan de Manejo</h2>
            </div>
            <div class="form-horizontal form-bordered">
                {!! Field::textarea('management_plan', null, ['id' => 'management_plan', 'placeholder' => 'Plan de manejo', 'template' => 'horizontalmodal', 'rows' => '3']) !!}
                
                <div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        {!! Form::button('Vista previa', ['class' => 'btn btn-primary', 'id' => 'submitEntry']) !!}
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

@endsection

@section('js_extra')    
    <script type="text/javascript">
        @if($diary->entry != "")
            var url_options = "{!! $url_options !!}";
            $('#page-content').load(url_options);
        @endif 
        var name = '{{ Auth::user()->doctors->name }}'; 
        var room = 'teleconsult';
        var image_record = "{{ URL::to('img/placeholders/icons/record.png') }}";
        var number_videos = 0;    
    </script>
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
    {!! Html::script('assets/js/pages/teleconsult.js') !!}
    {!! Html::script('assets/js/pages/webrtc.js') !!}
@endsection

@section('js_extra_page_content')    
    <script type="text/javascript">
    @if((isset($form_data) && isset($method)))
        var form_data = "{{ $form_data }}";
        var method = "{{ $method }}";
    @else
        console.log("{{ $form_dataa }}")
    @endif
    </script>
@endsection
