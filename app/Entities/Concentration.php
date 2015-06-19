<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Concentration extends Model {

	protected $fillable = ['id','name','value'];

	public $timestamps = true;
	public $increments = true;

    public static function allLists()
    {
        return self::lists('name', 'id');
    }

}
