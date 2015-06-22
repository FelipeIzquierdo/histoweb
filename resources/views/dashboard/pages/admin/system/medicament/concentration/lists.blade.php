@extends('dashboard.pages.layout')
	@section('title') 
	    Concentraciones
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Concentraciones
			<a href="{{ route('admin.system.medicament.concentrations.create') }}" class="btn btn-info" title="Nueva Concentración">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Concentraciones</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Valor (mg)</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($concentrations as $concentration)
							<tr>
								<td>{{ $concentration->name }}</td>
								<td><strong>{{ $concentration->value }}</strong></td>
								<td class="text-center">
									<a href="{{ route('admin.system.medicament.concentrations.edit', $concentration->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar Concentración"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $concentrations->render() !!}
	            </div>
			</div>
		</div>
	@endsection