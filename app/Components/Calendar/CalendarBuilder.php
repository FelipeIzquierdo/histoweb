<?php namespace Histoweb\Components\Calendar;

use Illuminate\Session\Store as Session;
use Carbon\Carbon; 

class CalendarBuilder {

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function diariesAndAvailableSchedule($diaries, $schedules)
    {
        
    }

    public function splitCollection($collection, $part = '+15 minutes')
    {
        $events = array();

        foreach ($collection as $key => $model) 
        {
            $event = $model->toArray();

            for ($timestamp = strtotime($model->start); $timestamp < strtotime($model->end); $timestamp = strtotime($part, $timestamp)) 
            { 
                $event['start'] = date('Y-m-d H:i:s', $timestamp);
                $event['end'] = date('Y-m-d H:i:s', strtotime($part, $timestamp));
                array_push($events, $event);
            }
        }

        return $events;
    }

    public function eventsOfCollection($collection)
    {
    	$events = array();
    	foreach ($collection as $key => $model) 
    	{
            $events[$key]['id'] = $model->id;
    		$events[$key]['start'] = $model->start;
    		$events[$key]['end'] = $model->end;
    		$events[$key]['title'] = $model->title;
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
    		$events[$key]['start'] = date('Y-m-d H:i:s', strtotime($date . ' ' . $start_time));
    		$events[$key]['end'] = date('Y-m-d H:i:s', strtotime($date . ' ' . $end_time));
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