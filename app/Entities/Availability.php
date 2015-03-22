<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model 
{
	protected $fillable = ['time_init', 'time_end'];
}
