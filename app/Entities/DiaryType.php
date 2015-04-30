<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class DiaryType extends Model {

	public $timestamps = true;
	public $increments = true;
	
	protected $fillable = ['name','time'];

	public static function allLists()
    {
        return self::lists('name', 'id');
    }

    public function getHoursAttribute()
    {
        $time = $this->time;
        if($time/60 >= 1){
            $hours = intval($time/60);
            $minutes = $time -($hours*60);
            if($minutes >= 10){
                return "0$hours:$minutes";
            }else{
                return "0$hours:0$minutes";
            }

        }else{
            return "00:$time";
        }
    }

}
