@extends('dashboard.pages.layout')
  @section('title') 
    @if($formulate->exists) Editar formula @else Nueva formula @endif
  @endsection
  
  @section('dashboard_title') 
    <h1>
      @if($formulate->exists) Editar formula, Paciente: {{ $entry->diary->patient->name }}  @else Nueva formula, Paciente: {{ $entry->diary->patient->name }}  @endif
    </h1>
    <h1> <a href="{{ route('assistance.options.formulate.create', $entry->id) }}" class="btn btn-info" title="Nueva formula">
            <i class="fa fa-plus"></i>
          </a>
    </h1> 
  @endsection 

  @section('dashboard_body') 
    <div class="row">
      <div class="col-sm-7 col-md-7 col-lg-7">
          <div class="block">
              <div class="block-title">
                  <h2>Datos de la Formula</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($formulate, $form_data) !!}
                  {!! Field::select( 'generic_medication_id', $generic_medication, null, [ 'id' => 'generic_medication_id','data-placeholder' => 'Medicamento Generico', 'template' => 'horizontal','onchange' =>'generic_medication()']) !!}
                  <div class="form-group">
                    <label class="col-md-3 control-label" for="name">Presentación</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            {!! Form::select( 'concentration_id', [], null, ['id' => 'presentation_id', 'data-placeholder' => 'Presentación', 'template' => 'horizontal','class' => 'form-control']) !!}
                            <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                        </div>
                    </div>
                  </div>
                  {!! Field::select( 'administration_route_id', $administration_route , null, ['id' => 'administration_route_id','data-placeholder' => 'Vía de administración', 'template' => 'horizontal','class' => 'form-control']) !!}
                  {!! Field::number( 'dose', null , ['min' => '0', 'template' => 'horizontal']) !!}
                  {!! Field::number( 'interval', null , ['min' => '0' , 'template' => 'horizontal']) !!}
                  {!! Field::number( 'limit', null , ['min' => '0' , 'template' => 'horizontal']) !!}
                  <div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
                    </div>
                  </div>
                {!! Form::close() !!}
              </div>
          </div>
      </div>

      <div class="col-sm-5 col-md-5 col-lg-5">
          <div class="block">
            <div class="block-title clearfix">
              <h2><span class="hidden-xs">Lista de</span> Lista de Formulación</h2>
            </div>
            <div class="table-responsive">
              <table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($formulate_e as $formulate_ee)
                    <tr>
                      <td>
                        {{ $formulate_ee->concentration->name }} - {{ $formulate_ee->concentration->unit_amount }} {{ $formulate_ee->concentration->unit_name }} x  {{ $formulate_ee->concentration->diluent_amount }} {{ $formulate_ee->concentration->diluent_name }} - vía {{ $formulate_ee->administrationRoute->name }} ,
                        Tomar {{ $formulate_ee->dose }} {{ $formulate_ee->presentation_name }} cada {{ $formulate_ee->interval }} horas durante {{ $formulate_ee->limit }} días.

                      </td>
                      <td class="text-center">
                        <a href="{{ route('assistance.options.formulate.edit', [$entry->id,$formulate_ee->id]) }}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar formular"><i class="fa fa-pencil"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
                <h1><a href="{{ route('assistance.entries.options', $entry->id) }}" class="btn btn-info" title="Nueva formula">
                    Finalizar Formulación
                    </a>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                        {!! $formulate_e->render() !!}
                    </div>
            </div>
          </div>
        </div>
    </div>

  @endsection

@section('js_extra')
   {!! Html::script('assets/js/pages/formulate.js') !!}
@stop