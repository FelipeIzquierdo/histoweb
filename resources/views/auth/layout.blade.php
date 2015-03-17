@extends ('app')

    @section ('css') 
        @include('auth.css')
        @yield('css_extra') 
    @endsection

    @section ('meta') 
    	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    @endsection

    @section ('class_body') class="auth" @endsection

    @section ('body')

        <div id="login-container">
            
            <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            	@yield('auth_title')
            </h1>

            @include('_partials.errors')

            <div class="block animation-fadeInQuickInv">
                <div class="block-title">
                    <div class="block-options pull-right">
                    	@yield('auth_buttons')
                    </div>
                    @yield('auth_header')
                </div>
                @yield('auth_form')
            </div>
            
            <footer style="color:white;" class="text-center animation-pullUp">
                <small><span id="year-copy"></span> &copy; <a href="http://www.histowebco.com/" style="color:white;" target="_blank">HistoWeb</a></small>
            </footer>
        
        </div>
    @endsection

    @section ('js') 
        @include('auth.js') 
        @yield('js_extra')
    @endsection


