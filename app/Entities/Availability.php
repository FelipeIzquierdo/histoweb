<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model 
{
	protected $fillable = ['start', 'end', 'group_id', 'state', 'doctor_id', 'surgery_id', 'type'];
    protected static  $color = [
        'available' => '#5cb85c',
        'used'      => '#f0ad4e',
        'discarded' => '#d9534f'
    ];
    protected static $colorType = [
        'personal'      => '#5cb85c',
        'telemedicine'  => '#f0ad4e'
    ];

    public static $types = ['personal' => 'Presencial', 'telemedicine' => 'Telemedicina']; 

    public function setTypeAttribute($value)
    {
        if(empty($value))
        {
            $this->attributes['type'] = 'personal';
        }
        else
        {
            $this->attributes['type'] = $value;   
        }
    }

    public function getTypeNameAttribute()
    {
        return self::$types[$this->type];
    }

	public function getTitleAttribute()
	{
		return Doctor::find($this->attributes['doctor_id'])->name;
	}

    public static function allPersonalAvailable($surgery_id)
    {
        $availabilities = Availability::whereHas("discardedSurgeries", function($query) use($surgery_id) {
            $query->whereSurgeryId($surgery_id);
        },'<',1)->whereNull('surgery_id')->whereType('personal')->get();
        return $availabilities;
    }

    public function discardedSurgeries()
    {
        return $this->belongsToMany('Histoweb\Entities\Surgery', 'discarded_availability');
    }

    public function getStateAttribute()
    {
        if($this->surgery_id)
        {
            return 'used';
        }

        return 'available';
    }

    public function getColorAttribute()
    {
        return self::$color[$this->state];
    }

    public function getColorOfTypeAttribute()
    {
        if($this->type == 'personal' && isset($this->surgery_id))
        {
            return '';
        }
        
        return self::$colorType[$this->type];
    }


	public static function nextGroupId()
	{
		$lastAvailability = self::orderBy('group_id')->first();
		
		if(is_null($lastAvailability))
		{
			return 1;
		}
		else
		{
			return $lastAvailability->group_id + 1;	
		}
	}

    public function surgery()
    {
        return $this->belongsTo('Histoweb\Entities\Surgery');
    }

    public function doctor()
    {
        return $this->belongsTo('Histoweb\Entities\Doctor');
    }

    public function diaries()
    {
        return $this->hasMany('Histoweb\Entities\Diary');
    }
}
