<li class="active">
    <a href="#" class="sidebar-nav-menu">
    	<i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
    	<i class="fa fa-rocket sidebar-nav-icon"></i>
    	<span class="sidebar-nav-mini-hide">Pacientes</span>
    </a>
    <ul>
        @foreach($doctor->getDiariesToday() as $diary)
	    	<li style="font-size:11px;">
                @if($diary->isCanAttend())
                    <a href="{{ route('assistance.create-entry', $diary->id)}}">
                        <span class="sidebar-nav-mini-hide {{$diary->class}}"> {{ $diary->time_start }} {{ $diary->patient->short_name }} - {{ $diary->type_es }}</span>
                    </a>
                @elseif($diary->isBeingTreated())
                    <a href="{{ route('assistance.entries.options', $diary->entry->id)}}">
                        <span class="sidebar-nav-mini-hide {{$diary->class}}"> {{ $diary->time_start }} {{ $diary->patient->short_name }} - {{ $diary->type_es }}</span>
                    </a>
                @else
                    <a href="#">
                        <span class="sidebar-nav-mini-hide {{$diary->class}}"> {{ $diary->time_start }} {{ $diary->patient->short_name }} - {{ $diary->type_es }}</span>
                    </a>
                @endif
	        </li> 
	    @endforeach
    </ul>
</li> 
