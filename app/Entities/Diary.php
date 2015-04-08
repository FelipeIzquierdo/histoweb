<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public function getTitleAttribute()
    {
        return Patient::find($this->attributes['patient_id'])->name;
    }

    protected $fillable = ['patient_id','doctor_id','type_id','start','end'];
    
    public function type()
    {
        return $this->belongsTo('Histoweb\Entities\DiaryType', 'type_id');
    }
}