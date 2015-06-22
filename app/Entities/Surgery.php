<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model {

	protected $fillable = ['name'];
    public $timestamps = true;

    public function getToolsIdAttribute()
    {
    	return $this->tools->lists('id');
    }

    public static function allLists()
    {
        return self::lists('name', 'id' );
    }

    public function tools()
    {
        return $this->belongsToMany('Histoweb\Entities\Tool')->withTimestamps();
    }

    public function availabilities()
    {
        return $this->hasMany('Histoweb\Entities\Availability');
    }

    public function doctors()
    {
        return $this->hasMany('Histoweb\Entities\Doctor');
    }

    public function diaries()
    {
        return $this->hasManyThrough('Histoweb\Entities\Diary', 'Histoweb\Entities\Availability');
    }

    public function discardedAvailabilities()
    {
        return $this->belongsToMany('Histoweb\Entities\Availability', 'discarded_availability');
    }
}
