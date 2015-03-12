<?php  
/**
* 
*/
class Regime extends Eloquent
{
	protected $table = 'T94REGIMEN';
	protected $primaryKey = 'T94CodRegimen';
	public $timestamps = false;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('T94Tipo', 'T94CodRegimen');
    }
}