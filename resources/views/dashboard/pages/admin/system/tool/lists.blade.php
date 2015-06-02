@extends('dashboard.pages.layout')
	@section('title') Herramientas @endsection

	@section('dashboard_title')
		<h1>
			<i class="gi gi-settings"></i>
			Herramientas 
			<a href="{{ route('admin.system.tools.create') }}" class="btn btn-info" title="Nueva Herramienta">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection

	@section('breadcrumbs')
		{!! Breadcrumbs::render('tools') !!}
	@endsection
	
	@section('dashboard_body')

		@foreach($tools as $tool)
			@include('dashboard.includes.bootstrap.widget', ['url_widget' => route("admin.system.tools.edit", $tool->id), 'icon_widget' => 'img/placeholders/icons/box.png', 'title_widget' => $tool->name])
		@endforeach

		<div class="row">
            <div class="col-xs-12">
                {!! $tools->render() !!}
            </div>
        </div>

	@endsection