@extends('dashboard.pages.layout')
	@section('title') 
	    Doctores 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-user_add"></i>
			Doctores
			<a href="{{ route('admin.company.doctors.create') }}" class="btn btn-info" title="Nuevo Doctor">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		@foreach($doctors as $doctor)
			<div class="col-sm-4">
				<div class="widget">
					<div class="widget-content text-right clearfix themed-background-flat">
						<a href="{{ route('admin.company.doctors.edit', $doctor->id) }}" class="pull-left">
							{!! Html::image($doctor->photo, $doctor->name, ['class' => 'img-circle img-thumbnail img-thumbnail-avatar-2x']) !!}
						</a>
						<h4 class="widget-heading text-light">{{$doctor->name}}</h4>
						<h5 class="widget-heading text-light-op">{{ $doctor->specialty->name }}</h5>
						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="background-color: {{$doctor->color}}; width: 100%"></div>
							</div>
						</div>
					<div class="widget-content themed-background-muted text-center">
						<div class="btn-group">
							<a href="{{ route('admin.company.doctors.availabilities.index', $doctor->id) }}" title="Dispoinibilidad" class="btn btn-effect-ripple btn-warning"><i class="fa fa-calendar"></i></a>
							<a href="{{ route('admin.company.doctors.schedules.index', $doctor->id) }}" title="Horario" class="btn btn-effect-ripple btn-success"><i class="fa fa-suitcase"></i></a>
							<a href="{{ route('admin.company.doctors.diaries.index', $doctor->id) }}" title="Citas" class="btn btn-effect-ripple btn-info"><i class="fa fa-phone"></i></a>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		<div class="row">
		    <div class="col-xs-12">
                {!! $doctors->render() !!}
            </div>
		</div>
	@endsection