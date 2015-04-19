<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class History extends Model
{
	protected $fillable = ['name', 'type'];

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists('type' ,'name' ,'id' );
    }

    public function historyType()
    {
        return $this->belongsTo('Histoweb\Entities\HistoryType', 'type');
    }

    public function getHistoryTypeNameAttribute()
    {
    	return $this->historyType->name;	
    }

}
