<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class GenericMedication extends Model
{
	protected $fillable = ['cod','name', 'description' , 'administration_route_presentation_id'] ;

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists('name' ,'id' );
    }

    public function AdministrationRoutePresentation()
    {
        return $this->belongsTo('Histoweb\Entities\AdministrationRoutePresentation', 'administration_route_presentation_id');
    }

    public function getPresentationNameAttribute()
    {
        return $this->AdministrationRoutePresentation->presentation->name;   
    }

    public function getAdministrationRouteNameAttribute()
    {
        return $this->AdministrationRoutePresentation->AdministrationRoute->name;   
    }

    public static function getPresentationMedicamentAttribute($medicament)
    {
        $val = [self::find($medicament)->AdministrationRoutePresentation];
        foreach ($val as $key => $value) {
            $val[$key]->presentation = $value->presentation;
        }
        return $val;
    }

    public static function getAdministrationRouteMedicamentAttribute($medicament,$presentation)
    {
        $id = self::find($medicament)->administration_route_presentation_id;
        $val = AdministrationRoutePresentation::whereRaw('id = ? and presentation_id = ?',[$id,$presentation])->get();
        foreach ($val as $key => $value) {
            $val->AdministrationRoute = $value->AdministrationRoute;
        }
        return $val;
    }
}