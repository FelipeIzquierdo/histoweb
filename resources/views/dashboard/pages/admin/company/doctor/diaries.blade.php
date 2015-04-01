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
                                {!! Field::select('patient_id', $patients, null, ['data-placeholder' => 'Seleccione un Pasiente', 'template' => 'clean', 'id' => 'patient']) !!}
                                {!! Field::select('type_id', $diaryTypes, null, ['data-placeholder' => 'Seleccione un tipo de cita', 'template' => 'clean', 'id' => 'type']) !!}
                                <div class="col-md-9 col-md-offset-6">
                                    <button type="submit" id="add-event-btn" class="btn btn-effect-ripple btn-primary">Agregar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-section" >
                        <h4>Draggable Events</h4>
                        <ul class="calendar-events" id='external-events'>
                            <li class='animation-fadeInQuick2Inv'><i class="fa fa-calendar"></i>My Event 1</li>
                            <li class='animation-fadeInQuick2Inv'><i class="fa fa-calendar"></i>My Event 2</li>
                            <li class='animation-fadeInQuick2Inv'><i class="fa fa-calendar"></i>My Event 1</li>
                            <li class='animation-fadeInQuick2Inv'><i class="fa fa-calendar"></i>My Event 2</li>
                        </ul>
                        <p>
                            <input type='checkbox' id='drop-remove' />
                            <label for='drop-remove'>remove after drop</label>
                        </p>
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
                        <h3 class="modal-title"><strong>Asignar Cita</strong></h3>
                    </div>
                    <div class="modal-body">
                                      <div class="form-horizontal form-bordered">

                                            {!! Field::select('patient_id', $patients, null, ['data-placeholder' => 'Seleccione un tipo de cita', 'template' => 'horizontal']) !!}
                                            {!! Field::select('type_id', $diaryTypes, null, ['data-placeholder' => 'Seleccione un tipo de cita', 'template' => 'horizontal']) !!}
                                            {!! Field::text( 'star', null, [ 'template' => 'horizontal']) !!}
                                          <div class="form-group form-actions">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
                                            </div>
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
		{!! Html::script('assets/js/pages/calendar/doctor/diaries.js') !!}
	    <script>
	    	var url = '{!! $url !!}';
	    	$(function(){ CompCalendar.init(); });
	    </script>
	@endsection