<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class DescribeProcedure extends Model {

    public $table = "describe_procedures";

    public $timestamps = true;

    public $increments = true;

    public $fillable = [
        "entry_id",
        "start_date",
        "start_time",
        "end_time",
        "surgery_id",
        "doctor_id",
        "anesthesia_type_id",
        "staff_id",
        "way_entry_id",
        "state_way_id",
        "description",
        "complications"
    ];

    public function setStartTimeAttribute($value)
    {
        return $this->attributes['start_time'] = date('H:i:s', strtotime($value));
    }

    public function setEndTimeAttribute($value)
    {
        return $this->attributes['end_time'] = date('H:i:s', strtotime($value));
    }

    public function surgery()
    {
        return $this->belongsTo('Histoweb\Entities\Surgery');
    }

    public function doctor()
    {
        return $this->belongsTo('Histoweb\Entities\Doctor');
    }

    public function anesthesiaType()
    {
        return $this->belongsTo('Histoweb\Entities\AnesthesiaType');
    }

    public function staff()
    {
        return $this->belongsTo('Histoweb\Entities\Staff');
    }

    public function wayEntry()
    {
        return $this->belongsTo('Histoweb\Entities\WayEntry');
    }

    public function stateWay()
    {
        return $this->belongsTo('Histoweb\Entities\StateWay');
    }

}
