<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model {

	protected $fillable = ['id','name'];

	public $timestamps = true;
	public $increments = true;

    public static function allLists()
    {
        return self::lists('name', 'id');
    }

}
