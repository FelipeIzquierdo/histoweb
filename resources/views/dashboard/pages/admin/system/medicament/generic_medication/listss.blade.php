@extends('dashboard.pages.layout')
	@section('title') 
	    Medicamentos Genéricos
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Medicamentos Genéricos
			<a href="{{ route('admin.system.medicament.generic-medications.create') }}" class="btn btn-info" title="Nuevo medicamento genérico">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Medicamentos Genéricos</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Códigoooo</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Presentación</th>
							<th>Vía de administración</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($generic as $medicament)
							<tr>
								<td>{{ $medicament->cod }}</td>
								<td><strong>{{ $medicament->name }}</strong></td>
								<td>{{ $medicament->description }}</td>
								<td>{{ $medicament->presentation_name }}</td>
								<td>{{ $medicament->administration_route_name }}</td>
								<td class="text-center">
									<a href="{{ route('admin.system.medicament.generic-medications.edit', $medicament->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar medicamento genérico"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $generic->render() !!}
	            </div>
			</div>
		</div>
	@endsection