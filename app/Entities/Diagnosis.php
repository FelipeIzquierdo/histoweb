<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model {

	protected $fillable = ['name'];

	public $timestamps = true;
	public $increments = true;

    public static function allLists()
    {
        return self::lists('name', 'id');
    }

}
