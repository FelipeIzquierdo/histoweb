@extends('dashboard.pages.layout')
	@section('title') 
	    Unidades
	@endsection

	@section('breadcrumbs')
		{!! Breadcrumbs::render('unit') !!}
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Unidades
			<a href="{{ route('admin.system.medicament.units.create') }}" class="btn btn-info" title="Nueva Unidad">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Unidades</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Nombre</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($units as $unit)
							<tr>
								<td>{{ $unit->name }}</td>
								<td class="text-center">
									<a href="{{ route('admin.system.medicament.units.edit', $unit->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar Unidad"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $units->render() !!}
	            </div>
			</div>
		</div>
	@endsection