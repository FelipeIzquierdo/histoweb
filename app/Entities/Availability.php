<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model 
{
	protected $fillable = ['start', 'end', 'group_id'];

	public function getTitleAttribute()
	{
		return 'Disponible';
	}

	public static function nextGroupId()
	{
		$lastAvailability = self::orderBy('group_id')->first();
		
		if(is_null($lastAvailability))
		{
			return 1;
		}
		else
		{
			return $lastAvailability->group_id + 1;	
		}
	}
}
