<?php  
/**
* 
*/
class MembershipType extends Eloquent
{
	protected $table = 'T001TIPOAFILIACION';
	protected $primaryKey = 'T001CodTipoAfiliacion';
	public $timestamps = false;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('T001Tipo', 'T001CodTipoAfiliacion');
    }
}



