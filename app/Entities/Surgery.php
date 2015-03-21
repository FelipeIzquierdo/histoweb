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
}
