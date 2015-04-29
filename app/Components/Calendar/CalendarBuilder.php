<?php namespace Histoweb\Components\Calendar;

use Illuminate\Session\Store as Session;
use Carbon\Carbon; 

class CalendarBuilder {

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getSchedulesAvailabilities($schedules, $availabilities)
    {
        $events = array();

        foreach ($schedules as  $schedule)
        {
            array_push($events,[
                'type'      => 'schedule',
                'start'     => $schedule->start,
                'end'       => $schedule->end,
                'color'     => '#5cafde',
                'title'     => $schedule->title,
                'id'        => 'sch-' . $schedule->id,
                'doctor_id'  => $schedule->doctor_id,
                'surgery_id' => $schedule->surgery_id
            ]);
        }
        
        foreach ($availabilities as  $availability)
        {
            array_push($events,[
                'type'  => 'availability',
                'start' => $availability->start,
                'end'   => $availability->end,
                'color' => $availability->color,
                'state' => $availability->state,
                'title' => $availability->title,
                'id' => 'ava-' . $availability->id,
                'doctor_id' => $availability->doctor_id,
                'group_id' => $availability->group_id
            ]);
        }
        return $events;
    }

    public function getSchedulesDiaries($doctor)
    {
        $events = array();

        foreach ($doctor->schedules as  $schedule)
        {
            array_push($events,[
                'type'  => 'schedule',
                'id' =>  'availableForMeeting',
                'start'     => $schedule->start,
                'end'       => $schedule->end,
                'rendering' => 'background'
            ]);
        }
        foreach ($doctor->diaries as  $diary)
        {
            array_push($events,[
                'type'  => 'diary',
                'start' => $diary->start,
                'end'   => $diary->end,
                'id'    => $diary->id,
                'title' => $diary->title,
                'doctor'=> $diary->doctor_id,
                'constraint'    => 'availableForMeeting'
            ]);
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