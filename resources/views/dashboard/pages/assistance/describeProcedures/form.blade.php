@extends('dashboard.pages.layout_on_window')

@section('dashboard_title')
    <h1>Paciente: {{ $entry->diary->patient->name }}</h1>
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('describe_procedure', $entry->id, $describe_procedures) !!}
@endsection

@section('dashboard_body')

    {!! Form::model($describe_procedures) !!}
        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Describir Procedimiento</h2>
            </div>
            <div class="form-horizontal form-bordered">
                {!! Field::text( 'start_date', null, ['placeholder' => 'Fecha Procedimiento', 'class' => 'input-datepicker', 'template' => 'horizontalmodal', 'data-date-format' => 'yyyy-mm-dd', 'id' => 'start_date']) !!}
                {!! Field::time('start_time', null,[ 'id' => 'start_time', 'template' => 'horizontalmodaltime']) !!}
                {!! Field::time('end_time', null, ['id' => 'end_time', 'template' => 'horizontalmodaltime']) !!}
                {!! Field::select('surgery_id', $surgeries, null, ['data-placeholder' => 'Seleccione consultorio', 'template' => 'horizontalmodal', 'id' =>'surgery_id']) !!}
                {!! Field::select('doctor_id', $doctors, null, ['data-placeholder' => 'Seleccione Doctor', 'template' => 'horizontalmodal', 'id' =>'doctor_id']) !!}
                {!! Field::select('staff_id', $staff, null, ['data-placeholder' => 'Seleccione Instrumentador', 'template' => 'horizontalmodal', 'id' =>'staff_id']) !!}
                {!! Field::select('anesthesia_type_id', $anesthesia_types, null, ['data-placeholder' => 'Seleccione Tipo de anestesia', 'template' => 'horizontalmodal', 'id' =>'anesthesia_type_id']) !!}
                {!! Field::select('way_entry_id', $way_entries, null, ['data-placeholder' => 'Seleccione Via de entrada', 'template' => 'horizontalmodal', 'id' =>'way_entry_id']) !!}
                {!! Field::select('state_way_id', $state_ways, null, ['data-placeholder' => 'Seleccione Estado de via', 'template' => 'horizontalmodal', 'id' =>'state_way_id']) !!}
                {!! Field::textarea( 'description', null, ['placeholder' => 'Descripción', 'template' => 'horizontalmodal', 'rows' => '3', 'id' =>'description']) !!}
                {!! Field::textarea( 'complications', null, ['placeholder' => 'Descripción', 'template' => 'horizontalmodal', 'rows' => '3', 'id' =>'complications']) !!}
            </div>
        </div>
        <div class="form-group form-actions">
                <div class="col-md-9 col-md-offset-3">
                    {!! Form::button('Vista previa', ['class' => 'btn btn-primary', 'type' => 'submit', 'id' => 'submitDescribeProcedure']) !!}
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
                    <h3 class="modal-title"><strong>Describir Procedimiento,</strong> {!! $entry->diary->patient->doc_type_doc !!} - {!! $entry->diary->patient->name !!} </h3>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal form-bordered">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fecha Inicio:</label>
                            <div class="col-md-9">
                                <p id="dateStart"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Hora Inicio:</label>
                            <div class="col-md-9">
                                <p id="timeStart"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Hora Fin:</label>
                            <div class="col-md-9">
                                <p id="timeEnd"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Consultorio o Quirofano:</label>
                            <div class="col-md-9">
                                <p id="surgery"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Anestesiólogo:</label>
                            <div class="col-md-9">
                                <p id="doctor"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Instrumentador:</label>
                            <div class="col-md-9">
                                <p id="staff"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tipo de anestesia:</label>
                            <div class="col-md-9">
                                <p id="anesthesiaType"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Vía de entrada:</label>
                            <div class="col-md-9">
                                <p id="wayEntry"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Estado de vía:</label>
                            <div class="col-md-9">
                                <p id="stateWay"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Descripción:</label>
                            <div class="col-md-9">
                                <p id="descriptionText"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Complicaiones:</label>
                            <div class="col-md-9">
                                <p id="complicationsText"></p>
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
    @if((isset($form_data) && isset($method)))
        var form_data = "{{ $form_data }}";
        var method = "{{ $method }}";
    @else
        console.log("{{ $form_dataa}}")
    @endif
</script>
{!! Html::script('assets/js/pages/confirm/describeProcedure.js') !!}
@endsection