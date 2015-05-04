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
      <div class="col-sm-8 col-md-8 col-lg-8">
          <div class="block">
              <div class="block-title">
                  <h2>Datos de la Formula</h2>
              </div>
              <div class="form-horizontal form-bordered">
                {!! Form::model($formulate, $form_data) !!}
                  {!! Field::select( 'medicament_id', $medicament, null, ['data-placeholder' => 'Medicamento', 'template' => 'horizontal']) !!}
                  {!! Field::select( 'presentation_id', $presentation, null, ['data-placeholder' => 'Presentación', 'template' => 'horizontal']) !!}
                  {!! Field::select( 'via_medicament_id', $viamedicament, null, ['data-placeholder' => 'Vía del medicamento', 'template' => 'horizontal']) !!}
                  {!! Field::number( 'concentration', null , ['min' => '0', 'template' => 'horizontal']) !!}
                  {!! Field::select( 'measure_id', $measure, null, ['data-placeholder' => 'Medida', 'template' => 'horizontal']) !!}
                  {!! Field::number( 'quantity', null , ['min' => '0', 'template' => 'horizontal']) !!}
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

      <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="block">
            <div class="block-title clearfix">
              <h2><span class="hidden-xs">Lista de</span> Lista de Formulación</h2>
            </div>
            <div class="table-responsive">
              <table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
                <thead>
                  <tr>
                    <th>Medicamento</th>
                    <th>Intervalo</th>
                    <th style="min-width: 50px;" class="text-center"><i class="fa fa-flash"></i></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($formulate_e as $formulate_ee)
                    <tr>
                      <td>{{ $formulate_ee->medicament_name }}</td>
                      <td>{{ $formulate_ee->interval }}</td>
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

@stop