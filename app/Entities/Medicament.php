<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class Medicament extends Model
{
	protected $fillable = ['cod','name', 'description'] ;

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists('name' ,'id' );
    }

}
