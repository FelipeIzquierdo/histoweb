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

    protected $fillable = ['type_id', 'start','end','entered_at','exit_at','patient_id', 'doctor_id', 'eps_id', 'membership_types_id'];
    
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
        return Doctor::find($this->attributes['doctor_id'])->name;
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
        if(isset($this->exit_at))
        {
            return 'text-warning';
        }
        if(isset($this->entered_at))
        {
            return 'text-success';
        }
        else
        {
            return 'text-info';
        }
        
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
}