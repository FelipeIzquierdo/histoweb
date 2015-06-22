@extends('dashboard.pages.layout')
	@section('title') 
	    Laboratorios
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Laboratorios
			<a href="{{ route('admin.system.medicament.labs.create') }}" class="btn btn-info" title="Nuevo laboratorio">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Laboratorios</h2>
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
						@foreach($labs as $lab)
							<tr>
								<td>{{ $lab->cod }}</td>
								<td><strong>{{ $lab->name }}</strong></td>
								<td>{{ $lab->description }}</td>
								<td class="text-center">
									<a href="{{ route('admin.system.medicament.labs.edit', $lab->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar laboratorio"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $labs->render() !!}
	            </div>
			</div>
		</div>
	@endsection