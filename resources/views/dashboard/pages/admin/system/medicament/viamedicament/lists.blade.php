@extends('dashboard.pages.layout')
	@section('title') 
	    Vía del medicamento
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Vía del medicamento
			<a href="{{ route('admin.system.medicament.via-medicaments.create') }}" class="btn btn-info" title="Nueva vía del medicamento">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Vía del medicamento</h2>
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
						@foreach($viamedicaments as $viamedicament)
							<tr>
								<td>{{ $viamedicament->name }}</td>
								<td><strong>{{ $viamedicament->description }}</strong></td>
								<td class="text-center">
									<a href="{{ route('admin.system.medicament.via-medicaments.edit', $viamedicament->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar vía del medicamento"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $viamedicaments->render() !!}
	            </div>
			</div>
		</div>
	@endsection