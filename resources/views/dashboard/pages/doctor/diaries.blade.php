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
	@section('dashboard_body')
<!-- FullCalendar Block -->
        <div class="block full">
            <div class="row">
                <div class="col-md-3 col-md-push-9 col-lg-2 col-lg-push-10">
                    <div class="block-section">
                        <!-- Add event functionality (initialized in js/pages/compCalendar.js) -->
                        <form>
                            <div class="input-group">
                                <input type="text" id="add-event" name="add-event" class="form-control" placeholder="What to do?">
                                <div class="input-group-btn">
                                    <button type="submit" id="add-event-btn" class="btn btn-effect-ripple btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-section" >
                        <ul class="calendar-events">
                            <li class="themed-background-warning"><i class="fa fa-calendar"></i> Admin Template</li>
                            <li class="themed-background-dark"><i class="fa fa-calendar"></i> Lunch</li>
                            <li class="themed-background-info"><i class="fa fa-calendar"></i> TV Shows</li>
                            <li class="themed-background-danger"><i class="fa fa-calendar"></i> Go to the gym</li>
                            <li><i class="fa fa-calendar"></i> Work meeting</li>
                            <li class="themed-background-info"><i class="fa fa-calendar"></i> Trip to Tokyo</li>
                            <li class="themed-background-success"><i class="fa fa-calendar"></i> Go for a walk</li>
                        </ul>
                        <div class="block-section text-center text-muted">
                            <small><i class="fa fa-arrows"></i> Drag and Drop Events</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-md-pull-3 col-lg-10 col-lg-pull-2">
                    <!-- FullCalendar (initialized in js/pages/compCalendar.js), for more info and examples you can check out http://arshaw.com/fullcalendar/ -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
<!-- END FullCalendar Block -->

<!-- Regular Fade -->
        <div id="modalFade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title"><strong>Cita</strong></h3>
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
		{!! Html::script('assets/js/pages/calendar/doctor/diaries.js') !!}
	    <script>
	    	var url = '{!! $url !!}';
	    	$(function(){ CompCalendar.init(); });
	    </script>
	@endsection