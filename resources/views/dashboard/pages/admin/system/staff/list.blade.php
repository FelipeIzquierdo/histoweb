@extends('dashboard.pages.layout')
	@section('title') 
	    Personal
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-check-square-o"></i>
			Personal
			<a href="{{ route('admin.system.staff.create') }}" class="btn btn-info" title="Nuevo Personal">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		@if($staff->isEmpty())
	        <div class="well text-center">Personal no encontrado.</div>
	    @else
			@foreach($staff as $staffs)
				<div class="col-sm-3">
					<a href="{{ route('admin.system.staff.edit', $staffs->id) }}" class="widget text-center">
						<div class="widget-content">
							<i class="fa fa-3x fa-check-square-o text-dark"></i>
						</div>
						<div class="widget-content themed-background-muted text-dark">
							{{ $staffs->name }} <br> 
							<strong>{{ $staffs->code }} </strong>
						</div>
					</a>
				</div>
			@endforeach
		@endif
		<div class="row">
		    <div class="col-xs-12">
                {!! $staff->render() !!}
            </div>
		</div>
	@endsection
