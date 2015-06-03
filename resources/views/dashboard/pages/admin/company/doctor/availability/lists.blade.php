@extends('dashboard.pages.layout')
	@section('title') 
	    Disponibilidad 
	@endsection

	@section('meta_extra') 
	    <meta name="_token" content="{{ csrf_token() }}"/> 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-calendar"></i>
			Disponibilidad
			<a href="{{ route('admin.company.doctors.availabilities.create', $doctor->id) }}" class="btn btn-info" title="Agregar Disponibilidad">
				<i class="fa fa-plus"></i>
			</a>
		</h1>
	@endsection
	
	@section('breadcrumbs')
    	{!! Breadcrumbs::render('doctors.availabilities', $doctor) !!}
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
                        <h3 class="modal-title"><strong>Dispoibilidad</strong></h3>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body form-group">
                            <label class="col-md-4 control-label" for="example-progress-username">Tipo:</label>
                            <div class="col-md-6">
                                <p><spam id="eventType"></spam></p>
                            </div>
                        </div>
                        <div class="modal-body form-group">
                            <label class="col-md-4 control-label" for="example-progress-username">Fecha:</label>
                            <div class="col-md-6">
                                <p><spam id="eventDate"></spam></p>
                            </div>
                        </div>
                        <div class="modal-body form-group">
                            <label class="col-md-4 control-label" for="example-progress-username">Hora de inicio:</label>
                            <div class="col-md-6">
                                <p><spam id="eventStart"></spam></p>
                            </div>
                        </div>
                        <div class="modal-body form-group">
                            <label class="col-md-4 control-label" for="example-progress-username">Hora fin:</label>
                            <div class="col-md-6">
                                <p><spam id="eventEnd"></spam></p>
                            </div>
                        </div>
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
		{!! Html::script('assets/js/pages/calendar/availabilities.js') !!}
	    <script>
	    	var url = '{!! $url !!}';
	    	$(function(){ CompCalendar.init(); });
	    </script>
	@endsection