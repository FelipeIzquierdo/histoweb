<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model {

	protected $fillable = ['cod','name'];

	public $timestamps = true;
	public $increments = true;

    public function getNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public static function allLists()
    {
        return self::lists('name', 'id');
    }

    public static function ListsViews()
    {
        return self::orderBy('updated_at', 'desc')->paginate(12);
    }
    
}
