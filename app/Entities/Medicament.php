<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class Medicament extends Model
{
	protected $fillable = ['name', 'description' ,'presentation_id'];

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists('name' ,'id' );
    }

    public function presentation()
    {
        return $this->belongsTo('Histoweb\Entities\Presentation', 'presentation_id');
    }

    public function getPresentationNameAttribute()
    {
    	return $this->presentation->name;	
    }

}
