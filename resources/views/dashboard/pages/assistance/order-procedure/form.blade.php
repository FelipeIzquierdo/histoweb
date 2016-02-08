@extends('dashboard.pages.layout_on_window')

@section('breadcrumbs')
    {!! Breadcrumbs::render('order_procedure', $entry->id) !!}
@endsection

@section('dashboard_title') 
<h1> Solicitar procedimiento, Paciente: {{ $entry->diary->patient->name }} </h1>
@endsection 

@section('dashboard_body')
    <div class="block">
        <div class="block-title clearfix">
            <h2><span class="hidden-xs">Solicitar procedimiento</h2>
        </div>
        <div class="form-horizontal form-bordered">
            {!! Field::select('procedure_id',$procedure ,null, ['id' => 'procedure_id', 'data-placeholder' => 'Procedimientos', 'template' => 'horizontalmodal', 'multiple' ]) !!}
        </div>
    </div>

    <div class="form-group form-actions">
            <div class="col-md-9 col-md-offset-3">
                {!! Form::button('Vista previa', ['class' => 'btn btn-primary', 'id' => 'submitOrderProcedure']) !!}
            </div>
        </div>
    </div>

    <!-- Regular Fade -->
    <div id="entryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"><strong>Solicitar Procedimiento,</strong> {!! $entry->diary->patient->doc_type_doc !!} - {!! $entry->diary->patient->name !!} </h3>
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
    <script type="text/javascript">
        @if((isset($form_data) && isset($method)))
            var form_data = "{{ $form_data }}";
            var method = "{{ $method }}";
        @else
            console.log("{{ $form_dataa}}")
        @endif
    </script>
    {!! Html::script('assets/js/pages/order-procedure.js') !!}
@endsection