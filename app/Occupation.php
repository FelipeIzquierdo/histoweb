<?php namespace Histoweb;



class Occupation extends Eloquent
{
	protected $table = 'occupations';
	protected $primaryKey = 'code_occupation';
	public $timestamps = false;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('type', 'code_occupation');
    }
}