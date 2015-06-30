@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Paciente: {{ $entry->diary->patient->name }}</h1>

@endsection

@section('sidebar_menu')
    @include('dashboard.pages.assistance.menu') 
@endsection

@section('dashboard_body')
<div class="col-sm-9">
    <iframe width="100%" height="460" src="{!! $pdf !!}" frameborder="0" allowfullscreen></iframe>
</div>
<div class="col-sm-3">
	<h4 class="sub-header">Opciones de Historia</h4>
    <a href="{{ route('assistance.options.formulate.create', $id) }}" class="btn btn-block btn-info">
        Formular
    </a>
    <a href="{{ route('assistance.options.order-procedures.create', $id) }}" class="btn btn-block btn-info">
        Solicitar procedimiento
    </a>
    <a href="{{ route('assistance.options.describeProcedures.create', $id) }}" class="btn btn-block btn-info">
        Describir procedimiento
    </a>
    <h4 class="sub-header">Reportes</h4>
    <a href="{{ route('assistance.entries.pdf', $entry->id) }}" class="btn btn-effect-ripple btn-block btn-primary" title="Nueva formula">
		Lista de Procedimientos
	</a>
	<hr>
    <a href="{{ route('assistance.exit', $id) }}" class="btn btn-block btn-warning">
        Dar salida
    </a>

</div>

<div class="col-sm-7">
    <div class="block">

	<div class="block-title clearfix">
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

    <div class="block">

    <div class="block-title clearfix">
        <h2><span class="hidden-xs">Lista de</span>Descripción Procedimiento</h2>
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

            @foreach($describe_procedures as $describe_procedure)
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
    <div class="row">
        <div class="col-xs-12">
            {!! $order_procedure->render() !!}
        </div>
    </div>
</div>
</div>

<div class="col-sm-5">
    <div class="block">
            <div class="block-title clearfix">
              <h2><span class="hidden-xs">Lista de</span> Lista de Formulación</h2>
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
                  @foreach($formulate_e as $formulate_ee)
                    <tr>
                      <td>
                        {{ $formulate_ee->generic_medication_name }} - {{ $formulate_ee->concentration }} {{ $formulate_ee->unit_name }} x  {{ $formulate_ee->diluent_name }} - vía {{ $formulate_ee->administration_route_name }} ,
                        Tomar {{ $formulate_ee->dose }} {{ $formulate_ee->presentation_name }} cada {{ $formulate_ee->interval }} horas durante {{ $formulate_ee->limit }} días.
                      </td>
                      <td class="text-center">
                        <a href="{{ route('assistance.options.formulate.edit', [$entry->id,$formulate_ee->id]) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar formular"><i class="fa fa-pencil"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
                <h1><a href="{{ route('assistance.entries.options', $entry->id) }}" class="btn btn-info" title="Nueva formula">
                    Finalizar Formulación
                    </a>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        {!! $formulate_e->render() !!}
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
    {!! Html::script('assets/js/pages/options.js') !!}
@endsection