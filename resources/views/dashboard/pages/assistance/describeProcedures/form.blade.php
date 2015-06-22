@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Paciente: {{ $entry->diary->patient->name }}</h1>
@endsection

@section('dashboard_body')
    
    {!! Form::open($form_data) !!}
    
        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Describir Procedimiento</h2>
            </div>
            <div class="form-horizontal form-bordered">
                {!! Field::dateRange('start_date', 'end_date', null, null, ['placeholder' => 'Desde'], ['placeholder' => 'Hasta']) !!}
                {!! Field::select('surgery_id', $surgeries, null, ['data-placeholder' => 'Seleccione consultorio', 'template' => 'horizontal']) !!}
                {!! Field::select('doctor_id', $doctors, null, ['data-placeholder' => 'Seleccione Doctor', 'template' => 'horizontal']) !!}
                {!! Field::select('staff_id', $staff, null, ['data-placeholder' => 'Seleccione Instrumentador', 'template' => 'horizontal']) !!}
                {!! Field::select('anesthesia_type_id', $anesthesia_types, null, ['data-placeholder' => 'Seleccione Tipo de anestesia', 'template' => 'horizontal']) !!}
                {!! Field::select('way_entry_id', $way_entries, null, ['data-placeholder' => 'Seleccione Via de entrada', 'template' => 'horizontal']) !!}
                {!! Field::select('state_way_id', $state_ways, null, ['data-placeholder' => 'Seleccione Estado de via', 'template' => 'horizontal']) !!}
                {!! Field::textarea( 'description', null, ['placeholder' => 'Descripcion', 'template' => 'horizontal', 'rows' => '3']) !!}
                {!! Field::textarea( 'complications', null, ['placeholder' => 'Descripcion', 'template' => 'horizontal', 'rows' => '3']) !!}
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
                <div id="append"> </div>
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
    {!! Html::script('assets/js/pages/confirm/describeProcedure.js') !!}
@endsection

