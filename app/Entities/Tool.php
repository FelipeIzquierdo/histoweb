<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tool extends Model {	

	use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = ['name'];
	
	public static function allLists()
    {
        return self::lists('name', 'id');
    }



}
