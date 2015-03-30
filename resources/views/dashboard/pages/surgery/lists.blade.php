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
			<div class="col-sm-4">
				<div class="widget">
					<div class="widget-content text-right clearfix themed-background-flat">
						<a href="{{ route('surgeries.edit', $surgery->id) }}" class="pull-left">
							{!! Html::image('img/placeholders/icons/build.png', $surgery->name, ['class' => 'img-circle img-thumbnail img-thumbnail-avatar-2x']) !!}
						</a>
						<h3 class="widget-heading text-light">{{$surgery->name}}</h3>
					</div>
					<div class="widget-content themed-background-muted text-center">
						<div class="btn-group">
							<a href="{{ route('surgeries.schedules.index', $surgery->id) }}" title="Horario" class="btn btn-effect-ripple btn-success"><i class="fa fa-calendar"></i> Horario</a>
							<a href="{{ route('surgeries.diaries.index', $surgery->id) }}" title="Citas" class="btn btn-effect-ripple btn-info"><i class="fa fa-calendar"></i> Citas</a>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		
		<div class="row">
            <div class="col-xs-12">
                {!! $surgeries->render() !!}
            </div>
        </div>
	@endsection