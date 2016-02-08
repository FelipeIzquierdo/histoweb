@include('dashboard.includes.telemedicine')

<!-- Alternative Sidebar -->
<div id="sidebar-alt" tabindex="-1" aria-hidden="true">
    <!-- Toggle Alternative Sidebar Button (visible only in static layout) -->
    <a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i class="fa fa-times"></i></a>

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll-alt" style="width: 420px;">
        <!-- Sidebar Content -->
        <div class="sidebar-content" style="width: 420px;">
            <!-- Profile -->
            <div class="sidebar-section">
                <h2 class="text-light">Videodiagnóstico</h2>

                <div id="leave-conference" class="btn btn-effect-ripple btn-danger" style="display:none;">
                    <strong> Colgar </strong> 
                </div>
                 <div id="init-conference" class="btn btn-effect-ripple btn-success">
                    <strong> Iniciar </strong> 
                </div>

            </div>
            <!-- END Profile -->

            <div class="sidebar-section"> 
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="invited_widget" class="widget">
                        <div class="widget-content themed-background-flat text-left clearfix">
                            <a href="javascript:void(0)" class="pull-right">
                                <img src="{{ URL::to('img/placeholders/icons/user.png') }}" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
                            </a>
                            <h3 class="widget-heading text-light"> {{ Auth::user()->doctors->name }} <br/> </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar-section"> 
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div id="sala" > </div>

                    <div id="doctor_widget" class="widget">
                        <div class="widget-content themed-background-flat text-left clearfix">
                            <a href="javascript:void(0)" class="pull-right">
                                <img src="{{ URL::to('img/placeholders/icons/video.png') }}" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
                            </a>
                            <h3 class="widget-heading text-light"> Doctor <br/> </h3>
                            <h4 class="widget-heading text-light-op">Especialista</h4>
                        </div>
                        <div class="widget-content themed-background-muted text-center">
                            <div class="btn-group">
                                <a class="btn btn-effect-ripple btn-success"><i class="fa fa-share"></i> Disponible </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Alternative Sidebar -->