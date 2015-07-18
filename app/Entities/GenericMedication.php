<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;
use Histoweb\Entities\Presentation;

class GenericMedication extends Model
{
	protected $fillable = ['cod','name', 'description'] ;

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists('name' ,'id' );
    }

    public static function ListsViews()
    {
    	return self::orderBy('updated_at', 'desc')->paginate(12);
    }
}