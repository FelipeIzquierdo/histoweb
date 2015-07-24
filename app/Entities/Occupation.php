<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
	public $timestamps = true;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('name', 'id')->all();
    }
}