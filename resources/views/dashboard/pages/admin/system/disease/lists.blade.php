@extends('dashboard.pages.layout')
	@section('title') 
	    Enfermedades
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Enfermedades
			<a href="{{ route('admin.system.diseases.create') }}" class="btn btn-info" title="Nuevo enfermedad">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection

	@section('breadcrumbs')
		{!! Breadcrumbs::render('disease') !!}
	@endsection

	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Enfermedades</h2>
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
						@foreach($diseases as $disease)
							<tr>
								<td><strong>{{ $disease->cod }}</strong></td>
								<td><strong>{{ $disease->name }}</strong></td>
								<td class="text-center">
									<a href="{{ route('admin.system.diseases.edit', $disease->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar enfermedad"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $diseases->render() !!}
	            </div>
			</div>
		</div>
	@endsection