<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class History extends Model
{
	protected $fillable = ['name', 'history_type_id'];

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::lists('name' ,'id');
    }

    public function historyType()
    {
        return $this->belongsTo('Histoweb\Entities\HistoryType');
    }

    public function getHistoryTypeNameAttribute()
    {
    	return $this->historyType->name;	
    }

}
