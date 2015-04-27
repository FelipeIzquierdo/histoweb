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
                                {!! Field::text('patient_id', null, ['placeholder' => 'Paciente', 'template' => 'clean', 'id' => 'patient']) !!}
                                <div class="input-group-btn">
                                    <button type="submit" id="add-event-btn" class="btn btn-effect-ripple btn-primary" style="overflow: hidden; position: relative;">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-section" >
                        <h4>Citas en Espera</h4>
                        <ul class="calendar-events" id='external-events'>

                        </ul>
                        <div class="block-section text-center text-muted">
                            <small><i class="fa fa-arrows"></i> Ubica las citas</small>
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
                        <h3 class="modal-title"><strong>Datos paciente</strong></h3>
                    </div>
                     <div class="row">
                          <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                              <div class="form-horizontal form-bordered">
                                {!! Field::selectSimple( 'doc_type_id', $doc_types, null, ['data-placeholder' => 'Tipo de documento', 'template' => 'horizontal', 'id' => 'doc_type_id']) !!}
                                {!! Field::text( 'doc', null, ['placeholder' => 'Documento', 'template' => 'horizontal', 'id' => 'doc']) !!}
                                {!! Field::selectSimple( 'sex', $genders, null, ['data-placeholder' => 'Género', 'template' => 'horizontal', 'id' => 'sex']) !!}
                                {!! Field::text( 'first_name', null, ['placeholder' => 'Nombres', 'template' => 'horizontal', 'id' => 'first_name']) !!}
                                {!! Field::text( 'last_name', null, ['placeholder' => 'Apellidos', 'template' => 'horizontal', 'id' => 'last_name']) !!}
                                {!! Field::text( 'date_birth', null, ['placeholder' => 'Fecha de nacimiento', 'class' => 'input-datepicker', 'template' => 'horizontal', 'data-date-format' => 'yyyy-mm-dd', 'id' => 'date_birth']) !!}
                                {!! Field::text( 'tel', null, ['placeholder' => 'Télefono', 'template' => 'horizontal', 'id' => 'tel']) !!}
                                {!! Field::email( 'email', null, ['placeholder' => 'Correo Electrónico', 'template' => 'horizontal', 'id' => 'email']) !!}
                                {!! Field::selectSimple('occupation_id', $occupations, null, ['data-placeholder' => 'Seleccione una ocupación', 'template' => 'horizontal', 'id' => 'occupation_id']) !!}
                                {!! Field::selectSimple('diaryTypes', $diaryTypes, null, ['data-placeholder' => 'Seleccione una ocupación', 'template' => 'horizontal', 'id' => 'diaryTypes']) !!}
                              </div>
                          </div>
                     </div>
                    <div class="modal-footer">
                        <a href="#!" class="btn btn-effect-ripple btn-primary" data-dismiss="modal" id="eventUpdate">Guardar</a>
                        <a href="#!" class="btn btn-effect-ripple btn-primary" data-dismiss="modal" id="eventCreate">Registar</a>
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
	        var doctorId = '{!! $doctor->id !!}';
	    	var url = '{!! $url !!}';
	    	$(function(){ CompCalendar.init(); });
	    </script>
	@endsection