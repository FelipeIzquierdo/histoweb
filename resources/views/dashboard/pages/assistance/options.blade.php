@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Paciente: {{ $entry->diary->patient->name }}</h1>
        <h1>
		<a href="{{ route('assistance.options.formulate.create', $id) }}" class="btn btn-info">
			Formular
		</a>
		<a href="{{ route('assistance.options.order-procedures.create', $id) }}" class="btn btn-info">
			Solicitar procedimiento
		</a>
		<a href="{{ route('assistance.exit', $id) }}" class="btn btn-warning">
			Dar salida
		</a>
	</h1>
@endsection

@section('sidebar_menu')
    @include('dashboard.pages.assistance.menu') 
@endsection

@section('dashboard_body')
<div class="block">

	<div class="block-title clearfix">
		<a href="{{ route('assistance.entries.pdf', $entry->id) }}" class="btn btn-effect-ripple btn-md btn-primary" title="Nueva formula">
			Descargar Reporte
		</a><br>
		<h2><span class="hidden-xs">Lista de</span> Procedimientos</h2>
	</div>
{!! Form::open($form_data) !!}
	<div class="table-responsive">
		<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
			<thead>
				<tr>
					<th>Procedimiento</th>
					<th>Tipo</th>
					<th style="min-width: 50px;" class="text-center"><i class="fa fa-file-excel-o"></i></th>
				</tr>
			</thead>
			<tbody>
			
				@foreach($order_procedure as $order_procedures)
					<tr>
						<td><strong>{{ $order_procedures->procedure_name }}</strong></td>
						<td>{{ $order_procedures->procedure_type_name }}</td>
						<td class="text-center">
							<button type="submit" value="{{ $order_procedures->procedure_id }}" data-toggle="tooltip" id="submitOptions" class="btn btn-danger" data-original-title="Borrar procedimiento"><i class="fa fa-times"></i></button>
							{!! Form::hidden('procedure','') !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
{!! Form::close() !!}
	<div class="row">
	    <div class="col-xs-12">
            {!! $order_procedure->render() !!}
        </div>
	</div>
</div>

<!-- Regular Fade -->
<div id="entryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>¿Desea eliminar el procedimiento?</strong></h3>
            </div>
            <div id="append"> </div>
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
    {!! Html::script('assets/js/pages/options.js') !!}
@endsection