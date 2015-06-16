<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model {

    protected $table = 'specialties';
    protected $primaryKey = 'id';

    protected $fillable = ['name','code'];

    public $timestamps = true;
    public $increments = true;
    public $errors;

    public static function allLists()
    {
    	return self::lists('name', 'id' );
    }

}
