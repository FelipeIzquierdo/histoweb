@extends('dashboard.pages.layout')
	@section('title') 
	    Medicamentos Comerciales
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Medicamentos Comerciales
			<a href="{{ route('admin.system.medicament.commercial-medications.create') }}" class="btn btn-info" title="Nuevo medicamento comercial">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Medicamentos Comerciales</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Código</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Medicamento genérico</th>
							<th>Laboratorio</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($medicament as $medicaments)
							<tr>
								<td>{{ $medicaments->cod }}</td>
								<td><strong>{{ $medicaments->name }}</strong></td>
								<td>{{ $medicaments->description }}</td>
								<td>{{ $medicaments->generic_medication_name }}</td>
								<td>{{ $medicaments->lab_name }}</td>
								<td class="text-center">
									<a href="{{ route('admin.system.medicament.commercial-medications.edit', $medicaments->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar medicamento comercial"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $medicament->render() !!}
	            </div>
			</div>
		</div>
	@endsection