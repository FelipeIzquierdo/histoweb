<?php namespace Histoweb;



class Doctor extends Eloquent
{
	protected $table = 'doctors';
	protected $primaryKey = 'id';
	public $timestamps = false;
	public $increments = true;
	public $errors;

	
}
