<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model {

	protected $fillable = ['cod', 'name'];

	public $timestamps = true;
	public $increments = true;

    public static function allLists()
    {
        return self::lists('name', 'id');
    }

}
