<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class DescribeProcedure extends Model {

    public $table = "describe_procedures";

    public $primaryKey = "id";

    public $timestamps = true;

    public $increments = true;

    public $fillable = [
        "entry_id",
        "start_date",
        "end_date",
        "surgery_id",
        "doctor_id",
        "anesthesia_type_id",
        "staff_id",
        "way_entry_id",
        "state_way_id",
        "description",
        "complications"
    ];

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
