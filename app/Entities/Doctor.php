<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $table = 'doctors';
	protected $primaryKey = 'id';
	public $timestamps = true;
	public $increments = true;
	public $errors;

    protected $fillable = ['cc','first_name','last_name','specialty_id'];

    public function getNameAttribute()
    {
    	return $this->first_name . ' ' . $this->last_name;
    }

    public function availabilities()
    {
        return $this->hasMany('Histoweb\Entities\Availability');
    }

    public function schedules()
    {
        return $this->hasMany('Histoweb\Entities\Schedule');
    }

    public function diaries()
    {
        return $this->hasMany('Histoweb\Entities\Diary');
    }    
}
