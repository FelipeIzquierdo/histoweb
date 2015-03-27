<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model {

	protected $fillable = ['name'];
    public $timestamps = true;

    public function tools()
    {
        return $this->belongsToMany('Histoweb\Entities\Tool')->withTimestamps();
    }

    public function getToolsIdAttribute()
    {
    	return $this->tools->lists('id');
    }

    public function schedules()
    {
        return $this->hasMany('Histoweb\Entities\Schedule');
    }

    public function doctors()
    {
        return $this->hasMany('Histoweb\Entities\Doctor');
    }

    public function discardedAvailabilities()
    {
        return $this->belongsToMany('Histoweb\Entities\Availability', 'discarded_availability');
    }
}
