<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class Formulate extends Model
{
	protected $fillable = [ 'administration_route_id','entry_id', 'concentration_id','dose','interval','limit'];

    protected $table = 'formulate';
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists( 'id' );
    }

    public function concentration()
    {
        return $this->belongsTo('Histoweb\Entities\Concentration','concentration_id');
    }

    public function administrationRoute()
    {
        return $this->belongsTo('Histoweb\Entities\AdministrationRoute','administration_route_id');
    }
    
}
