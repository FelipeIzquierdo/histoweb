<?php namespace Histoweb\Entities;
/**
* 
*/
use Illuminate\Database\Eloquent\Model;

class AdministrationRoute extends Model
{
	protected $fillable = ['name', 'description'];

	public $timestamps = true;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('name', 'id');
    }
}



