@extends('dashboard.pages.layout')
	@section('title') 
	    Instrumentadores
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-check-square-o"></i>
			Instrumentadores
			<a href="{{ route('admin.system.implementers.create') }}" class="btn btn-info" title="Nuevo Instrumentador">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		@foreach($implementers as $implementer)
			<div class="col-sm-3">
				<a href="{{ route('admin.system.implementers.edit', $implementer->id) }}" class="widget text-center">
					<div class="widget-content">
						<i class="fa fa-3x fa-check-square-o text-dark"></i>
					</div>
					<div class="widget-content themed-background-muted text-dark">
						{{ $implementer->name }} <br> 
						<strong>{{ $implementer->code }} </strong>
					</div>
				</a>
			</div>
		@endforeach
		<div class="row">
		    <div class="col-xs-12">
                {!! $implementers->render() !!}
            </div>
		</div>
	@endsection
