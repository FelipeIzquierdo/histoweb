<?php namespace Histoweb\Components\Calendar;

use Illuminate\Session\Store as Session;

class CalendarBuilder {

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function eventsOfCollection($collection)
    {
    	$events = array();
    	foreach ($collection as $key => $collection) 
    	{
            $events[$key]['id'] = $collection->id;
    		$events[$key]['start'] = $collection->start;
    		$events[$key]['end'] = $collection->end;
    		$events[$key]['title'] = $collection->title;
    	}

    	return $events;
    } 

    public function eventsOfData($data = array()) 
    {
        return $this->events($data['start_date'], $data['end_date'], $data['days'], $data['start_time'], $data['end_time']);
    }

    public function events($start_date, $end_date, $days = array(), $start_time, $end_time)
    {
    	$events = array();
    	$dates = $this->findDays($start_date, $end_date, $days);

    	foreach ($dates as $key => $date) 
    	{
    		$events[$key]['start'] = date('Y-m-d H:s:m', strtotime($date . ' ' . $start_time));
    		$events[$key]['end'] = date('Y-m-d H:s:m', strtotime($date . ' ' . $end_time));
    	}

    	return $events;
    }

    public function findDays($start_date, $end_date, $days = array())
    {
    	$dates = array();

    	for ($date = strtotime($start_date); $date < strtotime($end_date); $date = strtotime('+1 week', $date)) 
    	{ 
    		foreach ($days as $day) 
    		{
    			array_push($dates, date('Y-m-d', strtotime($day, $date)));
    		}
    	}

    	return $dates;
    }
    
} 