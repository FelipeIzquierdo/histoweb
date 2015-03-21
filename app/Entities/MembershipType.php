<?php namespace Histoweb\Entities;
/**
* 
*/
class MembershipType extends Eloquent
{
	protected $table = 'membership_types';
	protected $primaryKey = 'code_membership';
	public $timestamps = false;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('type', 'code_membership');
    }
}



