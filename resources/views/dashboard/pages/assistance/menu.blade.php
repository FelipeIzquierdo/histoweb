<li class="active">
    <a href="#" class="sidebar-nav-menu">
    	<i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
    	<i class="fa fa-rocket sidebar-nav-icon"></i>
    	<span class="sidebar-nav-mini-hide">Pacientes</span>
    </a>
    <ul>
        @foreach($diaries as $d)
	    	<li style="font-size:12px;">
                @if($entry = $d->hasActiveEntry())
                    <a href="{{ route('assistance.entries', $entry->id)}}">
                        <span class="sidebar-nav-mini-hide {{$d->class}}"> {{ $d->time_start }} {{ $d->patient->short_name }}</span>
                    </a>
                @else
                    <a href="#">
                        <span class="sidebar-nav-mini-hide {{$d->class}}"> {{ $d->time_start }} {{ $d->patient->short_name }}</span>
                    </a>
                @endif
	        </li> 
	    @endforeach
    </ul>
</li> 
