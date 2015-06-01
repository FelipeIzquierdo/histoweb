@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Recepción</h1>
@endsection

@section('meta_extra')
    <meta name="_token" content="{{ csrf_token() }}"/>
@endsection

@section('dashboard_body')
	<div class="block full" style="margin: 5px 0px; padding: 13px 0px;">
		<div class="row">
			<div class="col-md-6">
				{!! Field::select('doctor', $doctors, 1, ['data-placeholder' => 'Seleccione un doctor', 'id' => 'doctorSelect', 'template' => 'select-title', 'onchange' => 'changeTest()']) !!}
			</div>
		</div>
	</div>

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
                        <div class="help-block animation-pullUp" style="color: #de815c;" id="error-patient_id"></div>
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
                <div class="modal-footer">
                    <a href="#" class="btn btn-effect-ripple btn-primary" data-dismiss="modal" id="eventActivate"><i class="fa fa-check-square-o"></i> Activar Consulta</a>
                    <a href="#" class="btn btn-effect-ripple btn-danger" data-dismiss="modal" id="eventCancel"><i class="fa fa-times"></i> Cancelar cita</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END modal data event -->

    <!-- Regular Fade -->
    <div id="modalFade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"><strong>Datos paciente</strong></h3>
                </div>
                <form id="clickable-wizard" action="page_forms_wizard.php" method="post" class="form-horizontal form-bordered">
                    <div class="modal-body">
                        <!-- First Step -->
                        <div id="clickable-first" class="step">
                            <!-- Step Info -->
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <ul class="nav nav-pills nav-justified clickable-steps">
                                        <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-first"><i class="fa fa-user"></i> <strong>Datos Personales</strong></a></li>
                                        <li><a href="javascript:void(0)" data-gotostep="clickable-second"><i class="fa fa-pencil-square-o"></i> <strong>Datos Actuales</strong></a></li>
                                        <li><a href="javascript:void(0)" data-gotostep="clickable-third"><i class="fa fa-check"></i> <strong>Tipo Cita</strong></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- END Step Info -->
                            {!! Field::selectSimple( 'doc_type_id', $doc_types, null, ['data-placeholder' => 'Tipo de documento', 'template' => 'horizontalmodal', 'id' => 'doc_type_id']) !!}
                            {!! Field::text( 'doc', null, ['placeholder' => 'Documento', 'template' => 'horizontalmodal', 'id' => 'doc']) !!}
                            {!! Field::selectSimple( 'sex', $genders, null, ['data-placeholder' => 'Género', 'template' => 'horizontalmodal', 'id' => 'sex']) !!}
                            {!! Field::text( 'first_name', null, ['placeholder' => 'Nombres', 'template' => 'horizontalmodal', 'id' => 'first_name']) !!}
                            {!! Field::text( 'last_name', null, ['placeholder' => 'Apellidos', 'template' => 'horizontalmodal', 'id' => 'last_name']) !!}
                            {!! Field::text( 'date_birth', null, ['placeholder' => 'Fecha de nacimiento', 'class' => 'input-datepicker', 'template' => 'horizontalmodal', 'data-date-format' => 'yyyy-mm-dd', 'id' => 'date_birth']) !!}
                        </div>
                        <!-- END First Step -->

                        <!-- Second Step -->
                        <div id="clickable-second" class="step">
                            <!-- Step Info -->
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <ul class="nav nav-pills nav-justified clickable-steps">
                                        <li><a href="javascript:void(0)" class="text-muted" data-gotostep="clickable-first"><i class="fa fa-user"></i> <del><strong>Datos Personales</strong></del></a></li>
                                        <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-second"><i class="fa fa-pencil-square-o"></i> <strong>Datos Actuales</strong></a></li>
                                        <li><a href="javascript:void(0)" data-gotostep="clickable-third"><i class="fa fa-check"></i> <strong>Tipo Cita</strong></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- END Step Info -->
                            {!! Field::text( 'tel', null, ['placeholder' => 'Télefono', 'template' => 'horizontalmodal', 'id' => 'tel']) !!}
                            {!! Field::text( 'address', null, ['placeholder' => 'Dirección', 'template' => 'horizontalmodal', 'id' => 'address']) !!}
                            {!! Field::email( 'email', null, ['placeholder' => 'Correo Electrónico', 'template' => 'horizontalmodal', 'id' => 'email']) !!}
                            {!! Field::selectSimple('occupation_id', $occupations, null, ['data-placeholder' => 'Seleccione una ocupación', 'template' => 'horizontalmodal', 'id' => 'occupation_id']) !!}
                        </div>
                        <!-- END Second Step -->

                        <!-- Third Step -->
                        <div id="clickable-third" class="step">
                            <!-- Step Info -->
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <ul class="nav nav-pills nav-justified clickable-steps">
                                        <li><a href="javascript:void(0)" class="text-muted" data-gotostep="clickable-first"><i class="fa fa-user"></i> <del><strong>Datos Personales</strong></del></a></li>
                                        <li><a href="javascript:void(0)" class="text-muted" data-gotostep="clickable-second"><i class="fa fa-pencil-square-o"></i> <del><strong>Datos Actuales</strong></del></a></li>
                                        <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-third"><i class="fa fa-check"></i> <strong>Tipo Cita</strong></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- END Step Info -->
                           {!! Field::selectSimple('diaryTypes', $diaryTypes, null, ['data-placeholder' => 'Seleccione una ocupación', 'template' => 'horizontalmodal', 'id' => 'diaryTypes']) !!}
                           {!! Field::selectSimple('eps', $eps, null, ['data-placeholder' => 'Seleccione una eps', 'template' => 'horizontalmodal', 'id' => 'eps']) !!}
                           {!! Field::selectSimple('membershipTypes', $membershipTypes, null, ['data-placeholder' => 'Seleccione tipo de afiliación', 'template' => 'horizontalmodal', 'id' => 'membershipTypes']) !!}
                        </div>
                        <!-- END Third Step -->
                    </div>
                </form>
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
    {!! Html::script('assets/js/pages/formsWizardDiaries.js') !!}
    <script>
        $(function(){ FormsWizard.init(); });
    </script>
    <script>
        var doctorId = '{!! $doctor !!}';
        var url = '{!! $url !!}';
        $(function(){ CompCalendar.init(); });
    </script>
@endsection

