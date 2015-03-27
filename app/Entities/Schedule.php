<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model {

    protected $fillable = ['start', 'end','doctor_id','surgery_id'];
    public function getTitleAttribute()
    {
        return Doctor::find($this->attributes['doctor_id'])->name;
    }

}
