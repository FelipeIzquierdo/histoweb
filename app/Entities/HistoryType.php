<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class HistoryType extends Model
{
	protected $fillable = ['description','name'];
	
	public $timestamps = true;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::get()->lists('name' ,'id' );
    }
}
