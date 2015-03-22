@extends('dashboard.pages.layout')
	@section('title') 
	    Disponibilidad 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-calendar"></i>
			Disponibilidad
			<a href="{{ route('doctors.availabilities.create', $doctor->id) }}" class="btn btn-info" title="Agregar Disponibilidad">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('dashboard_body')
		<div class="block full">
	        <div class="row">
	            <div class="col-xs-12">
	                <div id="calendar"></div>
	            </div>
	        </div>
	    </div>		
	@endsection

	@section('js_extra')
		<!-- Load and execute javascript code used only in this page -->
		{!! Html::script('assets/js/pages/calendar/availabilities.js') !!}
	    <script>
	    	var url = '{!! $url !!}';
	    	$(function(){ CompCalendar.init(); });
	    </script>
	@endsection