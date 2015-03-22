<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model 
{
	protected $fillable = ['start', 'end'];

	public function getTitleAttribute()
	{
		return 'Disponible';
	}
}
