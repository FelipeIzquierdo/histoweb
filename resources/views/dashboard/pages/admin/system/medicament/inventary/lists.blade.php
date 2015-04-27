@extends('dashboard.pages.layout')
	@section('title') 
	    Inventario 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Inventario
			<a href="{{ route('admin.system.medicament.inventaries.create') }}" class="btn btn-info" title="Nuevo inventario">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Inventario</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Medicamento</th>
							<th>Presentación</th>
							<th>Concentración</th>
							<th>Medida</th>
							<th>Cantidad</th>

							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($inventaries as $inventary)
							<tr>
								<td>{{ $inventary->medicament_name }}</td>
								<td>{{ $inventary->presentation_name }}</td>
								<td>{{ $inventary->concentration }}</td>
								<td>{{ $inventary->measure_name }}</td>
								<td>{{ $inventary->quantity }}</td>
								<td class="text-center">
									<a href="{{ route('admin.system.medicament.inventaries.edit', $inventary->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar inventario"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $inventaries->render() !!}
	            </div>
			</div>
		</div>
	@endsection