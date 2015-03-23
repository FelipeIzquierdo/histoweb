@extends('app')
	@section('title') Bienvenido al Administrador de HistoWeb @endsection
	
    @section('meta')
		<meta name="description" content="Administrador de HistoWeb">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        @yield('meta_extra')
	@endsection
	
    @section('css')
		@include('dashboard.includes.css')
		@yield('css_extra')
	@endsection

	@section('body')
		<div id="page-wrapper" class="page-loading">
			<div class="preloader">
                <div class="inner">
                    <div class="preloader-spinner themed-background hidden-lt-ie10"></div>
                    <h3 class="text-primary visible-lt-ie10"><strong>Cargando..</strong></h3>
                </div>
            </div>
            <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
                <!-- Alternative Sidebar -->
                {{-- @include('dashboard.includes.right_sidebar') --}}
                <!-- END Alternative Sidebar -->

                <!-- Main Sidebar -->
                @include('dashboard.includes.sidebar')
                <!-- END Main Sidebar -->

                <!-- Main Container -->
                <div id="main-container">
                    @include('dashboard.includes.header')
                    <!-- END Header -->

                    <!-- Page content -->
                    <div id="page-content" style="position:relative;">
                        @yield('dashboard', 'Contenido del Dashboard')
                    </div>
                    <!-- END Page Content -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
			
		</div>
	@endsection
	@section('js')
		@include('dashboard.includes.js')
		@yield('js_extra')
	@endsection