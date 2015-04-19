@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Paciente: {{ $entry->diary->patient->name }}</h1>
@endsection

@section('sidebar_menu')
    @include('dashboard.pages.assistance.menu') 
@endsection

@section('dashboard_body')
    
    {!! Form::open(['route' => ['assistance.entries.history', $entry->id], 'method' => 'POST', 'id' => 'entryForm']) !!}
    
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_medical_history" class=""> Antecedentes médicos</a>
                        </h4>
                    </div>
                    <div id="collapse_medical_history" class="panel-collapse collapse" style="">
                        <div class="panel-body form-horizontal form-bordered">
                            {!! Field::select('medical_history[]', ['1' => 'd'], null, ['id' => 'medical_history', 'data-placeholder' => 'Antecedentes patologicos', 'template' => 'horizontal', 'multiple' ]) !!}
                            
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_surgical_history" class=""> Antecedentes quirurgicos</a>
                        </h4>
                    </div>
                    <div id="collapse_surgical_history" class="panel-collapse collapse" style="">
                        <div class="panel-body form-horizontal form-bordered">
                            {!! Field::select('surgical_history[]', ['1' => 'd'], null, ['id' => 'surgical_history', 'data-placeholder' => 'Antecedentes quirurgicos', 'template' => 'horizontal', 'multiple' ]) !!}
                            {!! Field::text('new_surgical_history', null, ['class' => 'input-tags', 'template' => 'horizontal']) !!}
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_traumatic_history" class=""> Antecedentes traumaticos</a>
                        </h4>
                    </div>
                    <div id="collapse_traumatic_history" class="panel-collapse collapse" style="">
                        <div class="panel-body form-horizontal form-bordered">
                            {!! Field::select('traumatic_history[]', ['1' => 'd'], null, ['id' => 'traumatic_history', 'data-placeholder' => 'Antecedentes traumaticos', 'template' => 'horizontal', 'multiple' ]) !!}
                            {!! Field::text('new_traumatic_history', null, ['class' => 'input-tags', 'template' => 'horizontal']) !!}
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_toxic_allergic_history" class=""> Antecedentes toxicos y alergicos</a>
                        </h4>
                    </div>
                    <div id="collapse_toxic_allergic_history" class="panel-collapse collapse" style="">
                        <div class="panel-body form-horizontal form-bordered">
                            {!! Field::select('toxic_allergic_history[]', ['1' => 'd'], null, ['id' => 'toxic_allergic_history', 'data-placeholder' => 'Antecedentes toxicos y alergicos', 'template' => 'horizontal', 'multiple' ]) !!}
                            {!! Field::text('new_toxic_allergic_history', null, ['class' => 'input-tags', 'template' => 'horizontal']) !!}
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_reproductive_history" class=""> Antecedentes ginecoobstetricos</a>
                        </h4>
                    </div>
                    <div id="collapse_reproductive_history" class="panel-collapse collapse" style="">
                        <div class="panel-body form-horizontal form-bordered">
                            {!! Field::select('reproductive_history[]', ['1' => 'd'], null, ['id' => 'reproductive_history', 'data-placeholder' => 'Antecedentes ginecoobstetricos', 'template' => 'horizontal', 'multiple' ]) !!}
                            {!! Field::text('new_reproductive_history', null, ['class' => 'input-tags', 'template' => 'horizontal']) !!}
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_hospitalizations" class=""> Hospitalizaciones</a>
                        </h4>
                    </div>
                    <div id="collapse_hospitalizations" class="panel-collapse collapse" style="">
                        <div class="panel-body form-horizontal form-bordered">
                            {!! Field::select('hospitalizations[]', ['1' => 'd'], null, ['id' => 'hospitalizations', 'data-placeholder' => 'Hospitalizaciones ', 'template' => 'horizontal', 'multiple' ]) !!}
                            {!! Field::text('new_hospitalizations', null, ['class' => 'input-tags', 'template' => 'horizontal']) !!}
                        </div>
                    </div>
                </div>

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
                {!! Field::select('diagnostics[]', $diagnostics, null, ['id' => 'diagnostics', 'data-placeholder' => 'Diagnosticos', 'template' => 'horizontal', 'multiple' ]) !!}
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
                        {!! Form::button('Guardar', ['class' => 'btn btn-primary', 'type' => 'submit', 'id' => 'submitEntry']) !!}
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
                    <h3 class="modal-title"><strong>Hisoria Clinica,</strong> {!! $entry->diary->patient->doc_type_doc !!} - {!! $entry->diary->patient->name !!} </h3>
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
                                <p id="modal_diagnostics"></p>
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
                    <button type="button" class="btn btn-effect-ripple btn-primary" data-dismiss="modal" id="confirm">Confirmar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END Regular Fade -->
    

@endsection

@section('js_extra')
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
@endsection

