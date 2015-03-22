@extends('dashboard.pages.layout')
	@section('title') 
	    Consultorios 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-calendar-o"></i>
			Consultorios 
			<a href="{{ route('surgeries.create') }}" class="btn btn-info" title="Nuevo Consultorio">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		@foreach($surgeries as $surgery)
			<div class="col-sm-3">
				<a href="{{ route('surgeries.edit', $surgery->id) }}" class="widget">
					<div class="widget-content themed-background-info text-light-op text-center">
						<div class="widget-icon">
							{!! Html::image('img/placeholders/icons/build.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
						</div>
					</div>
					<div class="widget-content text-dark text-center">
						<strong>{{ $surgery->name }}</strong>
					</div>
				</a>
			</div>
		@endforeach
	@endsection