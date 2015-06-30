@extends('dashboard.pages.layout')
	@section('title') 
	    EPS
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-calendar-o"></i>
			EPS
			<a href="{{ route('admin.system.eps.create') }}" class="btn btn-info" title="Nuevo Consultorio">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		@foreach($eps as $t_eps)
			<div class="col-sm-4">
				<div class="widget">
					<div class="widget-content text-right clearfix themed-background-flat">
						<a href="{{ route('admin.system.eps.edit', $t_eps->id) }}" class="pull-left">
							{!! Html::image($t_eps->photo, $t_eps->name, ['class' => 'img-circle img-thumbnail img-thumbnail-avatar-2x']) !!}
						</a>
						<h3 class="widget-heading text-light">{{$t_eps->name}}</h3>
					</div>
					<div class="widget-content themed-background-muted text-center">
						<div class="btn-group">
						</div>
					</div>
				</div>
			</div>
		@endforeach
		
		<div class="row">
            <div class="col-xs-12">
                {!! $eps->render() !!}
            </div>
        </div>
	@endsection