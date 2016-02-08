{!! Html::style('assets/css/layout_on_window.css') !!}
@yield('css_extra')
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
    <div class="col-md-9">
        @if(isset($before_url))
            <div id="toTop"><a class="btn btn-rounded btn-effect-ripple btn-info" onclick="load_url('{{ $before_url }}')" ><i class="fa fa-arrow-circle-left fa-2x"></i> </a></div>
        @endif
        @yield('dashboard_body')
    </div>
</div>
{!! Html::script('assets/js/app.js') !!}
@yield('js_extra')