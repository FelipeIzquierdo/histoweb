@extends('dashboard.layout')
@section('dashboard')
	<!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-section">
                    @yield('dashboard_title', 'Inicio')
                </div>
            </div>
            <div class="col-sm-5 hidden-xs">
                <div class="header-section">
                    @yield('breadcrumbs')
                </div>
            </div>
        </div>
    </div>
    <!-- END Blank Header -->
    @yield('dashboard_body')
@stop