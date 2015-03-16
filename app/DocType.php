<?php namespace Histoweb;



class DocType extends Eloquent
{
	protected $table = 'doc_types';
	protected $primaryKey = 'code_type';
	public $timestamps = false;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return ['' => 'Seleccione un tipo de documento'] + self::lists('type', 'doc_types');
    }
}
