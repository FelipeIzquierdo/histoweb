@extends('dashboard.pages.layout')
	@section('title') 
	    Medicamentos 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Medicamentos
			<a href="{{ route('admin.system.medicament.medicaments.create') }}" class="btn btn-info" title="Nuevo medicamento">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Medicamentos</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Código</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($medicaments as $medicament)
							<tr>
								<td>{{ $medicament->cod }}</td>
								<td><strong>{{ $medicament->name }}</strong></td>
								<td>{{ $medicament->description }}</td>
								<td class="text-center">
									<a href="{{ route('admin.system.medicament.medicaments.edit', $medicament->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar medicamento"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $medicaments->render() !!}
	            </div>
			</div>
		</div>
	@endsection