<?php namespace Histoweb\Entities;
/**
* 
*/
use Illuminate\Database\Eloquent\Model;

class ClinicHistories extends Model
{
	protected $fillable = ['name','name_system'];

	public $timestamps = true;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('name', 'id');
    }
}



