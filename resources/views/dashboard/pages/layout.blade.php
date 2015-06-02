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
    <div class="row">
        <div class="col-md-12">
            @yield('dashboard_body')
        </div>
    </div>
    
@stop