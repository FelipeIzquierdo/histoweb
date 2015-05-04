@extends('dashboard.pages.layout')
	@section('title') 
	    Afiliaciones
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Afiliaciones
			<a href="{{ route('admin.system.memberships.create') }}" class="btn btn-info" title="Nueva Afiliación">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Afiliaciones</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Nombres</th>
							<th>Descripción</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($memberships as $membership)
							<tr>
								<td>{{ $membership->name }}</td>
								<td><strong>{{ $membership->description }}</strong></td>
								<td class="text-center">
									<a href="{{ route('admin.system.memberships.edit', $membership->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar Afiliación"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $memberships->render() !!}
	            </div>
			</div>
		</div>
	@endsection