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
			@include('dashboard.includes.bootstrap.widget', ['url_widget' => route("surgeries.edit", $surgery->id), 'icon_widget' => 'img/placeholders/icons/build.png', 'title_widget' => $surgery->name])
		@endforeach
		
		<div class="row">
            <div class="col-xs-12">
                {!! $surgeries->render() !!}
            </div>
        </div>
	@endsection