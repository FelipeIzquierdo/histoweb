<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class WayEntry extends Model
{
    
	public $table = "way_entries";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "name",
		"description",
		"code"
	];

	

}
