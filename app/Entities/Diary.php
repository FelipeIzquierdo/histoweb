<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
	public $timestamps = true;
	public $increments = true;
	public $errors;

    protected $fillable = ['time_init','time_end'];
    
}