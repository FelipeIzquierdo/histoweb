<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $table = 'doctors';
	protected $primaryKey = 'id';
	public $timestamps = true;
	public $increments = true;
	public $errors;

    protected $fillable = ['cc','first_name','last_name','specialty_id'];

}
