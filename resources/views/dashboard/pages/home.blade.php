@extends('dashboard.pages.layout')

@section('dashboard_body')
    <div class="block full">
        <div class="row">
            <div class="col-xs-12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection

@section('dashboard_title')
	Agenda de citas
@endsection

@section('js_extra')
	<!-- Load and execute javascript code used only in this page -->
	{!! Html::script('assets/js/pages/compCalendar.js') !!}
    <script>$(function(){ CompCalendar.init(); });</script>
@endsection