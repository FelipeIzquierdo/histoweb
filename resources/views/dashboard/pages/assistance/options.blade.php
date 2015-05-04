@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Paciente: {{ $entry->diary->patient->name }}</h1>
        <h1>
		<a href="{{ route('assistance.options.formulate.create', $id) }}" class="btn btn-info" title="Nueva formula">
			Formular
		</a>
		<a href="{{ route('assistance.options.order-procedures.create', $id) }}" class="btn btn-info" title="Nueva formula">
			Solicitar procedimiento
		</a>
	</h1>
@endsection

@section('sidebar_menu')
    @include('dashboard.pages.assistance.menu') 
@endsection

@section('dashboard_body')
 		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Procedimientos</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Procedimiento</th>
							<th>Tipo</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-file-pdf-o"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($order_procedure as $order_procedures)
							<tr>
								<td><strong>{{ $order_procedures->procedure_name }}</strong></td>
								<td>{{ $order_procedures->procedure_type_name }}</td>
								<td class="text-center">
									<a href="{{ route('assistance.entries.pdf', $order_procedures->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Descargar procedimiento"><i class="fa fa-cloud-download"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $order_procedure->render() !!}
	            </div>
			</div>
		</div>
@endsection

@section('js_extra')
    {!! Html::script('assets/js/pages/confirm/entry.js') !!}
@endsection