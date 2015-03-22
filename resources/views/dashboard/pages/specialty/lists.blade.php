@extends('dashboard.pages.layout')
	@section('title') 
	    Especialidades 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-graduation-cap"></i>
			Especialidades 
			<a href="{{ route('specialties.create') }}" class="btn btn-info" title="Nueva Especialidad">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		@foreach($specialties as $specialty)
			<div class="col-sm-3">
				<a href="{{ route('specialties.edit', $specialty->id) }}" class="widget">
					<div class="widget-content themed-background-info text-light-op text-center">
						<div class="widget-icon">
							{!! Html::image('img/placeholders/icons/student.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
						</div>
					</div>
					<div class="widget-content text-dark text-center">
						<strong>{{ $specialty->name }}</strong>
					</div>
				</a>
			</div>
		@endforeach
	@endsection