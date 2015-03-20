<?php namespace Histoweb;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Surgery extends Model {

	protected $fillable = ['name'];
    public $timestamps = false;


}
