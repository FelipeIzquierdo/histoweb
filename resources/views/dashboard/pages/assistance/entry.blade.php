@extends('dashboard.pages.layout')

@section('dashboard_title')
    <h1>Paciente: {{ $entry->diary->patient->name }}</h1>
@endsection

@section('sidebar_menu')
	@include('dashboard.pages.assistance.menu') 
@endsection

@section('dashboard_body')
	{!! Form::open(['route' => ['assistance.entries.history', $entry->id], 'method' => 'POST']) !!}
	
		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Motivos de Consulta</h2>
			</div>
			<div class="form-horizontal form-bordered">
				{!! Field::select('reasons[]', $reasons, null, ['data-placeholder' => 'Motivos de consulta', 'template' => 'horizontal', 'multiple' ]) !!}
			    {!! Field::text('new_reasons', null, ['template' => 'horizontal', 'class' => 'input-tags']) !!}
			    {!! Field::textarea( 'present_illness', null, ['placeholder' => 'Enfermedad actual', 'template' => 'horizontal', 'rows' => '3']) !!}
			</div>
		</div>

		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Antecedentes Personales</h2>
			</div>
			<div class="panel-group" id="accordion">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h4 class="panel-title">
	                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class=""> Antecedentes Patologicos</a>
	                    </h4>
	                </div>
	                <div id="collapseTwo" class="panel-collapse collapse" style="">
	                    <div class="panel-body form-horizontal form-bordered">
	                        {!! Field::select('medical_history[]', ['1' => 'd'], null, ['data-placeholder' => 'Antecedentes patologicos', 'template' => 'horizontal', 'multiple' ]) !!}
	                        {!! Field::text('new_medical_history', null, ['class' => 'input-tags', 'template' => 'horizontal']) !!}
	                    </div>
	                </div>
	            </div>

	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h4 class="panel-title">
	                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class=""> Antecedentes Generales</a>
	                    </h4>
	                </div>
	                <div id="collapse2" class="panel-collapse collapse" style="">
	                    <div class="panel-body form-horizontal form-bordered">
	                        {!! Field::select('patologicos[]', ['1' => 'd'], null, ['data-placeholder' => 'Antecedentes patologicos', 'template' => 'horizontal', 'multiple' ]) !!}
	                        {!! Field::select('nevos[]', ['1' => 'd'], null, ['data-placeholder' => 'Antecedentes generales', 'template' => 'horizontal', 'multiple' ]) !!}
	                    </div>
	                </div>
	            </div>

	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h4 class="panel-title">
	                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class=""> Antecedentes Otro tipo</a>
	                    </h4>
	                </div>
	                <div id="collapse3" class="panel-collapse collapse" style="">
	                    <div class="panel-body form-horizontal">
	                        {!! Field::select('patologicos[]', ['1' => 'd'], null, ['data-placeholder' => 'Antecedentes patologicos', 'template' => 'horizontal', 'multiple' ]) !!}
	                        {!! Field::select('nevos[]', ['1' => 'd'], null, ['data-placeholder' => 'Antecedentes generales', 'template' => 'horizontal', 'multiple' ]) !!}
	                    </div>
	                </div>
	            </div>

	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h4 class="panel-title">
	                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class=""> Antecedentes Otro</a>
	                    </h4>
	                </div>
	                <div id="collapse4" class="panel-collapse collapse" style="">
	                    <div class="panel-body form-horizontal form-bordered">
	                        {!! Field::select('patologicos[]', ['1' => 'd'], null, ['data-placeholder' => 'Antecedentes patologicos', 'template' => 'horizontal', 'multiple' ]) !!}
	                        {!! Field::select('nevos[]', ['1' => 'd'], null, ['data-placeholder' => 'Antecedentes generales', 'template' => 'horizontal', 'multiple' ]) !!}
	                    </div>
	                </div>
	            </div>
	    	</div>
		</div>	

		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Revisión de Sistemas</h2>
			</div>
			<div class="form-horizontal form-bordered">
				{!! Field::select('system_revisions[]', $system_revisions, null, ['data-placeholder' => 'Revisiones de sistemas', 'template' => 'horizontal', 'multiple' ]) !!}
			    {!! Field::text('new_system_revisions', null, ['template' => 'horizontal', 'class' => 'input-tags']) !!}
			</div>
		</div>

		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Procedimientos</h2>
			</div>
			<div class="form-horizontal form-bordered">
				{!! Field::select('procedures[]', $procedures, null, ['data-placeholder' => 'Procedimientos', 'template' => 'horizontal', 'multiple' ]) !!}
			    {!! Field::text('new_procedures', null, ['template' => 'horizontal', 'class' => 'input-tags']) !!}
			</div>
		</div>	

		<div class="block">
			<div class="block-title clearfix">
				<h2><span class="hidden-xs">Plan de Manejo</h2>
			</div>
			<div class="form-horizontal form-bordered">
				{!! Field::textarea('management_plan', null, ['placeholder' => 'Plan de manejo', 'template' => 'horizontal', 'rows' => '3']) !!}
				
				<div class="form-group form-actions">
					<div class="col-md-9 col-md-offset-3">
						{!! Form::button('Guardar', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
					</div>
				</div>
			</div>
		</div>		
	{!! Form::close() !!}

@endsection

@section('js_extra')
	
@endsection

