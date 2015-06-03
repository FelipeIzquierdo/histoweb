<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Implementer extends Model
{
    
	public $table = "implementers";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "name",
		"description",
		"code"
	];

	public static $rules = [
	    "name" => "validations: required",
		"description" => "validations: required",
		"code" => "validations: required"
	];

}
