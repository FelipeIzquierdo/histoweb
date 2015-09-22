<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $table = 'doctors';
	protected $primaryKey = 'id';
	public $timestamps = true;
	public $increments = true;
	public $errors;
    public static $pathPhoto = 'img/placeholders/photos/doctors/';
    private static $defaultPhoto = 'img/placeholders/icons/doctor.png';
    protected static $colorType = [
        'personal'      => '#5cb85c',
        'telemedicine'  => '#f0ad4e'
    ];

    protected $fillable = ['cc','first_name','last_name','color','telemedicine','user_id','specialty_id'];

    public static function allListSpecialty($specialty_id)
    {
        return self::whereSpecialtyId($specialty_id)->get()->lists('name', 'id');
    }

    public static function allListSpecialtyName($specialty_name)
    {
        return self::allListSpecialty(Specialty::getCode($specialty_name));
    }

    public static function allListsAnesthesiologist()
    {
        return self::allListSpecialtyName('anesthesiology');
    }

    public function findAvailability($start, $end)
    {
        return $this->availabilities()
            ->where('start', '<=', $start)
            ->where('end', '>=', $end)
            ->first();
    }

    public function getDiariesToday()
    {
        return $this->diaries->sortBy('start')->filter(function($diary)
        {
            return $diary->isToday();
        });
    }

    public function getNameAttribute()
    {
    	return $this->first_name . ' ' . $this->last_name;
    }

    public static function allLists()
    {
        $data = [];
        foreach (self::get() as $key => $value) 
        {
            $id = '';
            $text = $value->first_name . ' ' . $value->last_name;

            if($value->specialty)
            {
                $text .= ' - ' . $value->specialty->name;
                $id = $value->id.'-personal';
            }

            $data[ $id ] = $text; // personal

            if($value->telemedicine)
            {
                $text .= ' - Telemedicina';
                $id = $value->id.'-telemedicine';
                $data[ $id ] = $text;
            }
            
        }
        
        return $data;
    }

    public function getNamePhotoAttribute()
    {
        return $this->id . '.jpg';
    }

    public function getPhotoAttribute()
    {
        $photo = self::$pathPhoto . $this->name_photo;
        
        if (\File::exists($photo))
        {
            return $photo;
        }

        return self::$defaultPhoto;
    }

    public function getAvailabitiesType( $name_type )
    {
        return $this->availabilities()->where('type', $name_type )->get();
    }

    public function getAvailabitiesTypeAll()
    {
        return $this->availabilities();
    }

    public function getDiariesType( $name_type )
    {
        return $this->diaries()->where('diaries.type', $name_type )->get();
    }

    public function getDiariesTypeAll()
    {
        return $this->diaries();
    }

    public function availabilities()
    {
        return $this->hasMany('Histoweb\Entities\Availability');
    }

    public function diaries()
    {
        return $this->hasManyThrough('Histoweb\Entities\Diary', 'Histoweb\Entities\Availability');
    }

    public function specialty()
    {
        return $this->belongsTo('Histoweb\Entities\Specialty');
    }

    public function users()
    {
        return $this->morphMany('Histoweb\User', 'office');
    }

}
