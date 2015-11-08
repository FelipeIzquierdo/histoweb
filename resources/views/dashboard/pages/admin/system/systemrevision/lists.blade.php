@extends('dashboard.pages.layout')
	@section('title') 
	    Revisión de sistemas
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Revisión de sistemas
			<a href="{{ route('admin.system.system-revisions.create') }}" class="btn btn-info" title="Nueva revisión de sistemas">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection

	@section('breadcrumbs')
		{!! Breadcrumbs::render('system_revision') !!}
	@endsection

	@section('dashboard_body')
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Lista de</span> Revisión de sistemas</h2>
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
						@foreach($revisions as $revision)
							<tr>								
								<td><strong>{{ $revision->name }}</strong></td>
								<td class="text-center">
									<a href="{{ route('admin.system.system-revisions.edit', $revision->id) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Edita revisión de sistemas"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="row">
			    <div class="col-xs-12">
	                {!! $revisions->render() !!}
	            </div>
			</div>
		</div>
	@endsection