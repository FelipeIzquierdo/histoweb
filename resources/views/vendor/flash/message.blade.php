@if (Session::has('flash_notification.message'))
    @if (Session::has('flash_notification.overlay'))
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')])
    @else
    	<script type="text/javascript">
    		$(function() {
	    		$.bootstrapGrowl("<h4><strong>Notificación</strong></h4> <p>{{ Session::get('flash_notification.message') }}</p>", {
	                type: "{{ Session::get('flash_notification.level') }}",
	                delay: 3000,
	                allow_dismiss: true,
	                offset: {from: 'top', amount: 20}
	            });
            });
    	</script>
    @endif
@endif
