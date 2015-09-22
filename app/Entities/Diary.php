<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diary extends Model
{    
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $timestamps = true;
    public $increments = true;
    public $errors;

    protected $fillable = ['availability_id', 'type_id', 'start','end','entered_at','exit_at','patient_id', 'eps_id', 'membership_types_id','type'];
    protected static $colorType = [
        'personal'      => '#0072C6',
        'telemedicine'  => '#de815c'
    ];
    protected $typeEs = [
        'personal'      => 'Personal',
        'telemedicine'  => 'Telediagnósis'
    ];

    public function getTypeEsAttribute()
    {
        return $this->typeEs[ $this->type ];
    }

    public function getTitleAttribute()
    {
        return Patient::find($this->attributes['patient_id'])->name;
    }

    public static function  findByPatient($patient)
    {
        return self::where('patient_id',$patient)->orderBy('id','desc')->first();
    }

    public function getNameDoctorAttribute()
    {
        return $this->availability->doctor->name;
    }

    public function getDiaryTypeAttribute()
    {
        return DiaryType::find($this->attributes['type_id'])->name;
    }

    public static function allToday()
    {
        return self::orderBy('start')->get()->filter(function($diary)
        {
            return $diary->isToday();
        });
    }

    public function getTimeStartAttribute()
    {
        return date("h:i A", strtotime($this->start));
    }

    public function getClassAttribute()
    {
        if($this->isCanAttend())
        {
            return 'text-success';
        }
        else if($this->entry)
        {
            if(isset($this->entry->exit_at))
            {
                return 'text-info';
            }
            else
            {
                return 'text-warning';
            }
        }
        else
        {
            return 'text-muted';
        }    
    }    

    public function isCanAttend()
    {
        if($this->entered_at && !$this->entry)
        {
            return true;
        }

        return false;
    }

    public function isBeingTreated()
    {
        if($this->entry && !isset($this->entry->exit_at))
        {
            return true;
        }

        return false;
    }
    
    public function hasActiveEntry()
    {
        if($this->entry && $this->entry->isActive())
        {
            return $this->entry;
        }

        return false;
    }

    public function isToday()
    {
        if(date('d', strtotime($this->start)) == date('d'))
        {
            return true;
        }

        return false;
    }

    public function getColorOfTypeAttribute()
    {
        return self::$colorType[ $this->type ];
    }

    public function type()
    {
        return $this->belongsTo('Histoweb\Entities\DiaryType', 'type_id');
    }

    public function entry()
    {
        return $this->hasOne('Histoweb\Entities\Entry');
    }

    public function patient()
    {
        return $this->belongsTo('Histoweb\Entities\Patient');
    }

    public function availability()
    {
        return $this->belongsTo('Histoweb\Entities\Availability');
    }

    public function getNewOrFirstEntry()
    {
        if($this->entry)
        {
            return $this->entry;
        }
        return new Entry(['diary_id' => $this->id]);
    }    
}