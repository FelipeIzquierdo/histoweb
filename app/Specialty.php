<?php namespace Histoweb;

use Illuminate\Database\Eloquent\Model;

class specialty extends Model {

    protected $table = 'specialties';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $increments = true;
    public $errors;

}
