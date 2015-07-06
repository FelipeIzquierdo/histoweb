<?php namespace Histoweb\Entities;
/**
* 
*/
use Illuminate\Database\Eloquent\Model;

class AdministrationRoutePresentation extends Model
{
	protected $fillable = ['route_id', 'presentation_id'];

	public $timestamps = true;
	public $increments = true;
	public $errors;

	public function presentation()
    {
        return $this->belongsTo('Histoweb\Entities\Presentation', 'presentation_id');
    }

	public function AdministrationRoute()
    {
        return $this->belongsTo('Histoweb\Entities\AdministrationRoute', 'route_id');
    }
  
}



