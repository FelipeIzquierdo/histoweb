<div id="sidebar">
    <!-- Sidebar Brand -->
    <div id="sidebar-brand" class="themed-background">
        <a href="{{url('/')}}" class="sidebar-title">
            <i class="fa fa-cube"></i> 
            <span class="sidebar-nav-mini-hide">HistoWeb</span>
        </a>
    </div>
    <!-- END Sidebar Brand -->

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="{{url('/')}}">
                        <i class="fa fa-bar-chart-o sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Inicio</span>
                    </a>
                </li> 
                @yield('sidebar_menu')  
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->

    <!-- Sidebar Extra Info -->
    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide" style="margin-bottom:10px;">
        <div class="text-center col-md-12">
            {{-- HTML::image(Auth::user()->preferredCompany->logo, Auth::user()->preferredCompany->name, array('style' => 'width:80%;')) --}}
        </div>
    </div>
    <!-- END Sidebar Extra Info -->
</div>