<?php  
/**
* 
*/
class Occupation extends Eloquent
{
	protected $table = 'T01OCUPACION';
	protected $primaryKey = 'T01CodOcupacion';
	public $timestamps = false;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('T01Tipo', 'T01CodOcupacion');
    }
}