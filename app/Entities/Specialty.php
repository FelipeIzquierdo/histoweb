<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model {

    protected $table = 'specialties';
    protected $primaryKey = 'id';

    protected $fillable = ['name','id'];

    public $timestamps = true;
    public $increments = false;
    public $errors;

    public static $codes = ['anesthesiology' => 2];

    public static function getCode($name)
    {
        return self::$codes[$name];
    }

    public static function allLists()
    {
    	return self::lists('name', 'id' );
    }

}
