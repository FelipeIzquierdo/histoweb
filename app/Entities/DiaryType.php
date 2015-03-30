<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class DiaryType extends Model {

	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $fillable = ['name','time'];

	public static function allLists()
    {
        return self::lists('name', 'id');
    }

}
