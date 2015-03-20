<?php namespace Histoweb;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model {

	protected $fillable = ['name'];
	public static function allLists()
    {
        return self::lists('name', 'id');
    }

}
