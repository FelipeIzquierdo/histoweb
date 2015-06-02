@extends('dashboard.pages.layout')
	@section('title') 
	    Horario 
	@endsection

	@section('meta_extra') 
	    <meta name="_token" content="{{ csrf_token() }}"/> 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-calendar"></i>
			Horario
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

	    <!-- Regular Fade -->
        <div id="modalFade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title"><strong>Horario de trabajo</strong></h3>
                    </div>
                    <div class="modal-body">
                        <p>Fecha: <spam id="eventDate"></spam></p>
                        <p>Hora de inicio: <spam id="eventStart"></spam></p>
                        <p>Hora fin: <spam id="eventEnd"></spam></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-effect-ripple btn-danger" data-dismiss="modal" id="eventDelete">Borrar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Regular Fade -->		
	@endsection

	@section('js_extra')
		<!-- Load and execute javascript code used only in this page -->
		{!! Html::script('assets/js/pages/calendar/doctor/schedules.js') !!}
	    <script>
	    	var url = '{!! $url !!}';
	    	$(function(){ CompCalendar.init(); });
	    </script>
	@endsection