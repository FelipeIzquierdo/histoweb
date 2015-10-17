<?php namespace Histoweb\Components\Calendar;

use Illuminate\Session\Store as Session;
use Carbon\Carbon; 

use Histoweb\Entities\Doctor;

class CalendarBuilder {

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getAvailabilities($used, $availables)
    {
        $events = array();

        foreach ($used as  $u)
        {
            array_push($events,[
                'type'      => 'schedule',
                'start'     => $u->start,
                'end'       => $u->end,
                'title'     => $u->title,
                'id'        => 'sch-' . $u->id,
                'doctor_id'  => $u->doctor_id,
                'surgery_id' => $u->surgery_id
            ]);
        }
        
        foreach ($availables as  $a)
        {
            array_push($events,[
                'type'  => 'availability',
                'start' => $a->start,
                'end'   => $a->end,
                'color' => $a->doctor->color,
                'state' => $a->state,
                'title' => $a->title,
                'id' => 'ava-' . $a->id,
                'doctor_id' => $a->doctor_id,
                'group_id' => $a->group_id
            ]);
        }
        return $events;
    }

    public function getDoctorAvailabilities($doctor)
    {
        $events = array();

        foreach ($doctor->availabilities as  $availability)
        {
            array_push($events,[
                'type'          => $availability->type,
                'start'         => $availability->start,
                'end'           => $availability->end,
                'id'            => $availability->id,
                'typeName'      => $availability->type_name,
                'color'         => $availability->color_of_type,
                'surgery_id'    => $availability->surgery_id,
                'doctor_id'     => $availability->doctor_id,
                'constraint'    => 'availableForMeeting'
            ]);
        }
        return $events;
    }

    public function getDoctorDiaries($doctor_t_id)
    {
        $availabilities = [];
        $diaries;
        $events = array();

        $doctor_all = explode('-', $doctor_t_id);
        $doctor_id = $doctor_all[0];

        $doctor = Doctor::find( $doctor_id );

        if( count($doctor_all) == 2 )
        {
            $name_type = $doctor_all[1];
            $availabilities = $doctor->getAvailabitiesType( $name_type );
            $diaries = $doctor->getDiariesType( $name_type );
        }
        else
        {
            $diaries = $doctor->getDiariesTypeAll;
        }

        foreach ($availabilities as  $availability)
        {
            array_push($events,[
                'type'      => 'schedule',
                'id'        => 'availableForMeeting',
                'start'     => $availability->start,
                'end'       => $availability->end,
                'rendering' => 'background',
                'color'     => $availability->color_of_type
            ]);
        }

        foreach ( $diaries as  $diary)
        {   
            array_push($events,[
                'type'       => 'diary',
                'start'      => $diary->start,
                'end'        => $diary->end,
                'id'         => $diary->id,
                'title'      => $diary->title,
                'doctor'     => $diary->doctor_id,
                'entered_at' => $diary->entered_at,
                'nameDoctor' => $diary->nameDoctor,
                'diaryType'  => $diary->diaryType,
                'color'      => $diary->color_of_type,
                'constraint' => 'availableForMeeting'
            ]);
        }
        
        return $events;
    }

    public function getSurgeryDiaries($surgery)
    {
        $events = array();

        foreach ($surgery->availabilities as  $availability)
        {
            array_push($events,[
                'type'      => 'schedule',
                'id'        =>  'availableForMeeting',
                'start'     => $availability->start,
                'end'       => $availability->end,
                'rendering' => 'background'
            ]);
        }

        foreach ($surgery->diaries as  $diary)
        {
            array_push($events,[
                'type'  => 'diary',
                'start' => $diary->start,
                'end'   => $diary->end,
                'id'    => $diary->id,
                'title' => $diary->title,
                'doctor'=> $diary->doctor_id,
                'nameDoctor' => $diary->nameDoctor,
                'diaryType'  => $diary->diaryType,
                'constraint' => 'availableForMeeting'
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