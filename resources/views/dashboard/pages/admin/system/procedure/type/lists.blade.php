@extends('dashboard.pages.layout')
	@section('title') 
	    Tipos de procedimientos 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-check-square-o"></i>
			Tipos de procedimientos
			<a href="{{ route('admin.system.procedure-types.create') }}" class="btn btn-info" title="Nuevo tipo de antecedente">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
			<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Tipos de procedimientos</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripción</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($types as $type)
							<tr>
								<td><strong>{{ $type->name }}</strong></td>
								<td>{{ $type->description }}</td>
								<td class="text-center">
									<a href="{{ route('admin.system.procedure-types.edit', $type->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar tipo de antecedente"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $types->render() !!}
	            </div>
			</div>
		</div>
	@endsection


