@extends('dashboard.pages.layout')
	@section('title') 
	    Pacientes 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Pacientes
			<a href="{{ route('admin.company.patients.create') }}" class="btn btn-info" title="Nuevo Paciente">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection

	@section('breadcrumbs')
		{!! Breadcrumbs::render('patients') !!}
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Pacientes</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Documento</th>
							<th>Nombre</th>
							<th>Genero</th>
							<th>Email</th>
							<th>Télefono</th>
							<th>Usuario</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($patients as $patient)
							<tr>
								<td>{{ $patient->doc_type_doc }}</td>
								<td><strong>{{ $patient->name }}</strong></td>
								<td>{{ $patient->gender }}</td>
								<td>{{ $patient->email }}</td>
								<td>{{ $patient->tel }}</td>
								@if (isset($patient->users->email))
          							<td>{{ $patient->users->email }}</td>
          						@else
          							<td> Sin asignar </td>
       							@endif
								<td class="text-center">
									<a href="{{ route('admin.company.patients.edit', $patient->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar Paciente"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $patients->render() !!}
	            </div>
			</div>
		</div>
	@endsection