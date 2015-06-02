@extends('dashboard.pages.layout')
	@section('title') 
	    Citas asignadas 
	@endsection

	@section('meta_extra') 
	    <meta name="_token" content="{{ csrf_token() }}"/> 
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-calendar"></i>
			Citas asginadas
		</h1>
	@endsection

    @section('breadcrumbs')
        {!! Breadcrumbs::render('doctors.diaries', $doctor) !!}
    @endsection

	@section('dashboard_body')
        <!-- FullCalendar Block -->
        <div class="block full">
            <div class="row">
                <div class="col-sm-12">
                    <!-- FullCalendar (initialized in js/pages/compCalendar.js), for more info and examples you can check out http://arshaw.com/fullcalendar/ -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <!-- END FullCalendar Block -->

        <!-- modal data event -->
        <div id="modalDataEvent" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title"><strong>Datos de Cita</strong></h3>
                    </div>
                    <div class="modal-body">
                        <label class="col-md-4 control-label" for="example-progress-username">Paciente:</label>
                        <p id="eventPatient"></p>
                        <label class="col-md-4 control-label" for="example-progress-username">Doctor:</label>
                        <p id="eventDoctor"></p>
                        <label class="col-md-4 control-label" for="example-progress-username">Tipo de Cita:</label>
                        <p id="eventDiaryType"></p>
                        <label class="col-md-4 control-label" for="example-progress-username">Fecha:</label>
                        <p id="eventDate"></p>
                         <label class="col-md-4 control-label" for="example-progress-username">Hora inicio:</label>
                        <p id="eventStart"></p>
                        <label class="col-md-4 control-label" for="example-progress-username">Hora fin:</label>
                        <p id="eventEnd"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END modal data event -->
	@endsection

	@section('js_extra')
		<!-- Load and execute javascript code used only in this page -->
		{!! Html::script('assets/js/pages/calendar/doctor/simple-diaries.js') !!}
		{!! Html::script('assets/js/pages/formsWizardDiaries.js') !!}
        <script>
            $(function(){ FormsWizard.init(); });
        </script>
	    <script>
	        var doctorId = '{!! $doctor->id !!}';
	    	var url = '{!! $url !!}';
	    	$(function(){ CompCalendar.init(); });
	    </script>
	@endsection