@extends('dashboard.pages.layout_on_window')

@section('dashboard_title') 
    <h1>Paciente: {{ $entry->diary->patient->name }}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('option',$entry->id) !!}
@endsection

@section('dashboard_body')
<div class="col-sm-9">
    <iframe width="100%" height="460" src="{!! $entry->getHistoryPdf() !!}" frameborder="0" allowfullscreen></iframe>
</div>
<div class="col-sm-3">
	<h4 class="sub-header">Opciones de Historia</h4>
    <a id="btn-options" class="btn btn-block btn-info" onclick="load_url('{{ route('assistance.options.formulate.create', $entry->id) }}')">
        Formular
    </a>
    <a id="btn-order-procedures" onclick="load_url('{{ route('assistance.options.order-procedures.create', $entry->id) }}')" class="btn btn-block btn-info">
        Solicitar procedimiento
    </a>
    <a id="btn-describe-procedures" onclick="load_url('{{ route('assistance.options.describeProcedures.create', $entry->id) }}')" class="btn btn-block btn-info">
        Describir procedimiento
    </a>
    <h4 class="sub-header">Reportes</h4>
    <a href="{{ route('assistance.entries.pdf', $entry->id) }}" class="btn btn-effect-ripple btn-block btn-primary" title="Nueva formula">
		Lista de Procedimientos
	</a>
	<hr>
    <a href="{{ route('assistance.exit', $entry->id) }}" class="btn btn-block btn-warning">
        Dar salida
    </a>

</div>

<div class="col-sm-7">
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
					<th style="min-width: 50px;" class="text-center"><i class="fa fa-file-excel-o"></i></th>
				</tr>
			</thead>
			<tbody>

				@foreach($entry->getOrderProcedures() as $order_procedure)
					<tr>
						<td><strong>{{ $order_procedure->procedure_name }}</strong></td>
						<td>{{ $order_procedure->procedure_type_name }}</td>
						<td class="text-center">
							<button type="submit" value="{{ $order_procedure->procedure_id }}" data-toggle="tooltip" id="submitOptions" class="btn btn-danger" data-original-title="Borrar procedimiento"><i class="fa fa-times"></i></button>
							{!! Form::hidden('procedure','') !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
    <div class="block">

        <div class="block-title clearfix">
            <h2><span class="hidden-xs">Procedimientos</span> solicitados</h2>
        </div>
        <div class="table-responsive">
            <table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
                <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Nombre Doctor</th>
                    <th style="min-width: 50px;" class="text-center"><i class="fa fa-file-pdf-o"></i></th>
                </tr>
                </thead>
                <tbody>

                @foreach($entry->getDescribeProcedures() as $describe_procedure)
                <tr>
                    <td><strong>{{ $describe_procedure->description }}</strong></td>
                    <td>{{ $describe_procedure->doctor->name }}</td>    
                    <td class="text-center">
                        <a href="/documents/describeProcedure/{!! $entry->diary->patient->doc !!}-{!! $describe_procedure->id !!}.pdf">
                        <button type="submit" data-toggle="tooltip" class="btn btn-success" data-original-title="Ver Descripción de procedimiento"><i class="fa fa-download"></i></button>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-sm-5">
    <div class="block">
            <div class="block-title clearfix">
              <h2><span class="hidden-xs">Lista de</span> Formulación</h2>
            </div>
            <div class="table-responsive">
              <table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($formulations as $formulation)
                    <tr>
                      <td>
                        {{ $formulation->for_humans }}
                      </td>
                      <td class="text-center">
                        <a onclick="load_url('{{ route('assistance.options.formulate.update', [$entry->id,$formulation->id]) }}')" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar formular"><i class="fa fa-pencil"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        {!! $formulations->render() !!}
                    </div>
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
            console.log("{{ $form_dataa }}")
        @endif
    </script>
    {!! Html::script('assets/js/pages/options.js') !!}
@endsection