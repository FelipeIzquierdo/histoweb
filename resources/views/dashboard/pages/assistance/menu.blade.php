<li class="active">
    <a href="#" class="sidebar-nav-menu">
    	<i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
    	<i class="fa fa-rocket sidebar-nav-icon"></i>
    	<span class="sidebar-nav-mini-hide">Pacientes</span>
    </a>
    <ul>
        @foreach($diaries as $di)
	    	<li style="font-size:12px;">
                @if($di->isCanAttend())
                    <a href="{{ route('assistance.create-entry', $di->id)}}">
                        <span class="sidebar-nav-mini-hide {{$di->class}}"> {{ $di->time_start }} {{ $di->patient->short_name }}</span>
                    </a>
                @elseif($di->isBeingTreated())
                    <a href="{{ route('assistance.entries.options', $di->entry->id)}}">
                        <span class="sidebar-nav-mini-hide {{$di->class}}"> {{ $di->time_start }} {{ $di->patient->short_name }}</span>
                    </a>
                @else
                    <a href="#">
                        <span class="sidebar-nav-mini-hide {{$di->class}}"> {{ $di->time_start }} {{ $di->patient->short_name }}</span>
                    </a>
                @endif
	        </li> 
	    @endforeach
    </ul>
</li> 
