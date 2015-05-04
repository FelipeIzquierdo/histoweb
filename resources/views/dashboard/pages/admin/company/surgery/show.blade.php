@extends('dashboard.pages.layout')
	@section('title') 
	    Consultorios 
	@endsection

	@section('dashboard_title')
		<h1>
			{{$surgery->name}}
		</h1>
	@endsection
	
	@section('dashboard_body')
			<div class="col-sm-3">
				<a href="{{ route('surgeries.edit', $surgery->id) }}" class="widget">
					<div class="widget-content themed-background-info text-light-op text-center">
						<div class="widget-icon">
							{!! Html::image('img/placeholders/icons/build.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
						</div>
					</div>
					<div class="widget-content text-dark text-center">
						<strong>Editar</strong>
					</div>
				</a>
			</div>
			<div class="col-sm-3">
                <a href="{{ route('surgeries.schedules.index', $surgery->id) }}" class="widget">
                    <div class="widget-content themed-background-info text-light-op text-center">
                        <div class="widget-icon">
                            {!! Html::image('img/placeholders/icons/build.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
                        </div>
                    </div>
                    <div class="widget-content text-dark text-center">
                        <strong>Horario</strong>
                    </div>
                </a>
            </div>
	@endsection