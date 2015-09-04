@extends('dashboard.pages.layout')
	@section('title') 
	    Administración del Sistema
	@endsection

	@section('dashboard_title')
		<h1>
			<i class="fa fa-desktop"></i>
			Administración del Sistema
		</h1>
	@endsection

	@section('breadcrumbs')
		{!! Breadcrumbs::render('system') !!}
	@endsection
	
	@section('dashboard_body')
		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.users.index'), 'icon_widget' => 'img/placeholders/icons/user.png', 'title_widget' => 'Usuarios'])

		<!--@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.roles.index'), 'icon_widget' => 'img/placeholders/icons/role.png', 'title_widget' => 'Roles']) -->

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.tools.index'), 'icon_widget' => 'img/placeholders/icons/tool.png', 'title_widget' => 'Herramientas'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.specialties.index'), 'icon_widget' => 'img/placeholders/icons/student.png', 'title_widget' => 'Especialidades'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.diary-types.index'), 'icon_widget' => 'img/placeholders/icons/medical.png', 'title_widget' => 'Tipos de citas'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.memberships.index'), 'icon_widget' => 'img/placeholders/icons/membership.png', 'title_widget' => 'Tipos de afiliación'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.procedure-types.index'), 'icon_widget' => 'img/placeholders/icons/procedure-type.png', 'title_widget' => 'Tipo de Procedimientos'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.procedures.index'), 'icon_widget' => 'img/placeholders/icons/procedure.png', 'title_widget' => 'Procedimientos'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.diseases.index'), 'icon_widget' => 'img/placeholders/icons/diagnosis.png', 'title_widget' => 'Enfermedades'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.system-revisions.index'), 'icon_widget' => 'img/placeholders/icons/system-revision.png', 'title_widget' => 'Revisión de sistemas'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.reasons.index'), 'icon_widget' => 'img/placeholders/icons/reason.png', 'title_widget' => 'Motivos de consulta'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.history-types.index'), 'icon_widget' => 'img/placeholders/icons/history-type.png', 'title_widget' => 'Tipos de antecedentes'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.histories.index'), 'icon_widget' => 'img/placeholders/icons/history.png', 'title_widget' => 'Antecedentes'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.medicament'), 'icon_widget' => 'img/placeholders/icons/medicament.png', 'title_widget' => 'Medicamentos'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.eps.index'), 'icon_widget' => 'img/placeholders/icons/eps.png', 'title_widget' => 'EPS'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.professions.index'), 'icon_widget' => 'img/placeholders/icons/profession.png', 'title_widget' => 'Profesiones'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.anesthesiaTypes.index'), 'icon_widget' => 'img/placeholders/icons/anesthesiaType.png', 'title_widget' => 'Tipos de Anestesia'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.stateWays.index'), 'icon_widget' => 'img/placeholders/icons/stateWay.png', 'title_widget' => 'Estados de via'])

		@include('dashboard.includes.bootstrap.widget', ['url_widget' => route('admin.system.wayEntries.index'), 'icon_widget' => 'img/placeholders/icons/wayEntry.png', 'title_widget' => 'Vias de entrada'])
	@endsection