@extends('dashboard.layout')
@section('dashboard')
	<!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-section">
                    <h1><i class="@yield('dashboard_icon')"></i> @yield('dashboard_title', 'Inicio')</h1>
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