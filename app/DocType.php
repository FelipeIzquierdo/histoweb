<?php  
/**
* 
*/
class DocType extends Eloquent
{
	protected $table = 'T023TIPODOCID';
	protected $primaryKey = 'T023CodTipo';
	public $timestamps = false;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return ['' => 'Seleccione un tipo de documento'] + self::lists('T023Tipo', 'T023CodTipo');
    }
}
