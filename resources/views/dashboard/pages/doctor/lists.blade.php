@extends('dashboard.pages.layout')
	@section('dashboard_title')
		<h1>
			<i class="fa fa-calendar-o"></i>
			Doctores
			<a href="{{ route('doctor.create') }}" class="btn btn-info" title="Nuevo Doctor">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		@foreach($doctors as $doctor)
			<div class="col-sm-3">
				<a href="{{ route('doctor.edit', $doctor->id) }}" class="widget">
					<div class="widget-content themed-background-info text-light-op text-center">
						<div class="widget-icon">
							<i class="fa fa-calendar-o"></i>
						</div>
					</div>
					<div class="widget-content text-dark text-center">
						<strong>{{ $doctor->fist_name }}</strong>
						<strong>{{ $doctor->last_name }}</strong>
					</div>
				</a>
			</div>
		@endforeach
	@endsection