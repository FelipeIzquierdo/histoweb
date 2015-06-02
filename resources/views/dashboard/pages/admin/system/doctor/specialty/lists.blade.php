@extends('dashboard.pages.layout')
	@section('title') 
	    Especialidades 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-graduation-cap"></i>
			Especialidades 
			<a href="{{ route('admin.system.specialties.create') }}" class="btn btn-info" title="Nueva Especialidad">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection

	@section('breadcrumbs')
    	{!! Breadcrumbs::render('specialties') !!}
  	@endsection
	
	@section('dashboard_body')
		@foreach($specialties as $specialty)
			@include('dashboard.includes.bootstrap.widget', ['url_widget' => route("admin.system.specialties.edit", $specialty->id), 'icon_widget' => 'img/placeholders/icons/student.png', 'title_widget' => $specialty->name])
		@endforeach
		
		<div class="row">
            <div class="col-xs-12">
                {!! $specialties->render() !!}
            </div>
        </div>
	@endsection