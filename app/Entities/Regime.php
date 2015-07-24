<?php namespace Histoweb\Entities;



class Regime extends Eloquent
{
	protected $table = 'regimes';
	protected $primaryKey = 'code_regime';
	public $timestamps = false;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('type', 'code_regime')->all();
    }
}