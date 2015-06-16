<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class StateWay extends Model
{
    
	public $table = "state_ways";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "name",
		"description",
		"code"
	];
	

}
