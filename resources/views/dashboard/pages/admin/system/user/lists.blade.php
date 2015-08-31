@extends('dashboard.pages.layout')
	@section('title') 
	    Usuarios
	@endsection

	@section('breadcrumbs')
		{!! Breadcrumbs::render('users') !!}
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Usuarios
			<a href="{{ route('admin.system.users.create') }}" class="btn btn-info" title="Nuevo Usuario">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Usuarios</h2>
			</div>
			<div class="table-responsive">
				<table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>Nombres</th>
							<th>Correo Electrónico</th>
							<th>Rol</th>
							<th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td><strong>{{ $user->email}}</strong></td>
								<td>{{ $user->roles->name }}</td>
								<td class="text-center">
									<a href="{{ route('admin.system.users.edit', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar Usuario"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $users->render() !!}
	            </div>
			</div>
		</div>
	@endsection