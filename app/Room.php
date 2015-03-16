<?php namespace Histoweb;

class Room extends Eloquent
{
	protected $table = 'rooms';
	protected $fillable = ['name', 'session', 'created_by'];

	public $timestamps = false;
	public $increments = true;
	public $errors;    
}
