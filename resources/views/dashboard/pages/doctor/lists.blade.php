@extends('dashboard.pages.layout')
	@section('title') 
	    Doctores 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i></i>
			Doctores
			<a href="{{ route('doctors.create') }}" class="btn btn-info" title="Nuevo Doctor">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		@foreach($doctors as $doctor)
			<div class="col-sm-3">
				<a href="{{ route('doctors.edit', $doctor->id) }}" class="widget">
					<div class="widget-content themed-background-info text-light-op text-center">
						<div class="widget-icon">
							{!! Html::image('img/placeholders/icons/doctor.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
						</div>
					</div>
					<div class="widget-content text-dark text-center">
						<strong>{{ $doctor->name }}</strong>
					</div>
				</a>
			</div>
		@endforeach
	@endsection