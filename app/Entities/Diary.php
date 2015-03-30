<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
	public $timestamps = true;
	public $increments = true;
	public $errors;

    protected $fillable = ['time_init','time_end'];
    
    public function type()
    {
        return $this->belongsTo('Histoweb\Entities\DiaryType', 'type_id');
    }
}