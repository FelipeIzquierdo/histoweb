@extends('dashboard.pages.layout')
	@section('title') 
	    Doctores 
	@endsection

	@section('dashboard_title')
		<h1>
			Doctor {{$doctor->name}}
		</h1>
	@endsection
	
	@section('dashboard_body')
			<div class="col-sm-3">
              <a href="{{ route('doctors.availabilities.index', $id) }}" class="widget">
                  <div class="widget-content  text-light-op text-center" style="background-color: {{$doctor->color}};">
                      <div class="widget-icon">
                          {!! Html::image('img/placeholders/icons/doctor.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
                      </div>
                  </div>
                  <div class="widget-content text-dark text-center">
                      <strong>Disponibilidad</strong>
                  </div>
              </a>
          </div>
          <div class="col-sm-3">
              <a href="{{ route('doctors.edit', $id) }}" class="widget">
                  <div class="widget-content  text-light-op text-center" style="background-color: {{$doctor->color}};">
                      <div class="widget-icon">
                          {!! Html::image('img/placeholders/icons/doctor.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
                      </div>
                  </div>
                  <div class="widget-content text-dark text-center">
                      <strong>Editar</strong>
                  </div>
              </a>
          </div>
          <div class="col-sm-3">
            <a href="{{ route('doctors.diaries.index', $id) }}" class="widget">
                <div class="widget-content  text-light-op text-center" style="background-color: {{$doctor->color}};">
                    <div class="widget-icon">
                        {!! Html::image('img/placeholders/icons/doctor.png', 'Icon Doctor', ['class' => 'img-circle img-thumbnail ']) !!}
                    </div>
                </div>
                <div class="widget-content text-dark text-center">
                    <strong>Citas</strong>
                </div>
            </a>
        </div>
	@endsection