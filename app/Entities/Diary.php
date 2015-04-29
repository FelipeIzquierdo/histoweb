<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
	public $timestamps = true;
	public $increments = true;
	public $errors;


    protected $fillable = ['type_id', 'start','end', 'patient_id', 'doctor_id', 'eps_id'];
    
    public function getTitleAttribute()
    {
        return Patient::find($this->attributes['patient_id'])->name;
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
    	if($entry = $this->entry)
    	{
    		if($entry->active)
    		{
    			return 'text-info';
    		}
    		else
    		{
    			return 'text-success';
    		}
    	}
    	else
    	{
    		return 'text-warning';
    	}
    }

    public function createEntry($data = null)
    {
    	if(!is_null($data))
    	{
    		$this->fill($data);
    		$this->save();
    	}
    	
    	return Entry::create([
    		'diary_id' 	=> $this->id
    	]);
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