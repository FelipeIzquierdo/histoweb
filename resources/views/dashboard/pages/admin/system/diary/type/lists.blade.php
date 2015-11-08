@extends('dashboard.pages.layout')
	@section('title') 
	    Tipos de citas 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-check-square-o"></i>
			Tipos de citas
			<a href="{{ route('admin.system.diary-types.create') }}" class="btn btn-info" title="Nuevo tipo de cita">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('breadcrumbs')
		{!! Breadcrumbs::render('diary_types') !!}
	@endsection

	@section('dashboard_body')
		@foreach($types as $type)
			<div class="col-sm-3">
				<a href="{{ route('admin.system.diary-types.edit', $type->id) }}" class="widget text-center">
					<div class="widget-content">
						<i class="fa fa-3x fa-check-square-o text-dark"></i>
					</div>
					<div class="widget-content themed-background-muted text-dark">
						{{ $type->name }} <br> 
						<strong>{{ $type->time }} minutos</strong>
					</div>
				</a>
			</div>
		@endforeach
		<div class="row">
		    <div class="col-xs-12">
                {!! $types->render() !!}
            </div>
		</div>
	@endsection


