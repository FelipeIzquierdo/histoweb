@extends('dashboard.pages.layout')
	@section('title') 
	    Herramientas 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-settings"></i>
			Herramientas 
			<a href="{{ route('tools.create') }}" class="btn btn-info" title="Nueva Herramienta">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		@foreach($tools as $tool)
			<div class="col-sm-3">
				<a href="{{ route('tools.edit', $tool->id) }}" class="widget">
					<div class="widget-content themed-background-info text-light-op text-center">
						<div class="widget-icon">
							{!! Html::image('img/placeholders/icons/box.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail']) !!}
						</div>
					</div>
					<div class="widget-content text-dark text-center">
						<strong>{{ $tool->name }}</strong>
					</div>
				</a>
			</div>
		@endforeach
	@endsection