<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
	protected $table = 'entries';
	protected $fillable = ['diary_id', 'present_illness', 'management_plan'];

	public $timestamps = true;
	public $increments = true;

    private static function generateSerial($patient_id)
    {
        return self::where('patients_id', $patient_id)->count() + 1;
    }

    public function isActive()
    {
        if($this->active == 1)
        {
            return true;
        }

        return false;
    }

    public function scopeLastActive($query)
    {
        return $query->whereActive(1)->orderBy('created_at', 'desc')->first();
    }

    public function saveHistory($data)
    {
        $this->fill($data);
        $this->active = 0;
        $this->save();

        $this->syncNewReasons($data['new_reasons']);
        if(array_key_exists('reasons', $data))
        {
            $this->reasons()->sync($data['reasons']);
        }
        
        $this->syncNewSystemRevisions($data['new_system_revisions']);
        if(array_key_exists('system_revisions', $data))
        {
            $this->systemRevisions()->sync($systemRevisions);
        }
        
        if(array_key_exists('procedures', $data))
        {
            $this->procedures()->sync($procedures);
        }

        if(array_key_exists('diagnostics', $data))
        {
            $this->diagnostics()->sync($diagnostics);
        }
    } 

    public function syncNewReasons($newReasons)
    {   
        if (!empty($newReasons)) 
        {
            $newReasons = explode(",", $newReasons);
            $this->saveNewReasons($newReasons);
        }
    }

    public function saveNewReasons($reasons)
    {
        foreach ($reasons as $name) {
            $reason = Reason::firstOrNew(['name' => $name]);
            $this->reasons()->save($reason);
        }
    }

    public function syncNewSystemRevisions($systemRevisions, $newSystemRevisions = null)
    {
        if (!empty($newSystemRevisions)) 
        {
            $newSystemRevisions = explode(",", $newSystemRevisions);
            $this->saveNewReasons($newSystemRevisions);
        }
    }

    public function saveNewSystemRevisions($systemRevisions)
    {
        foreach ($systemRevisions as $name) {
            $systemRevision = SystemRevision::firstOrNew(['name' => $name]);
            $this->systemRevisions()->save($systemRevision);
        }
    }

    public function reasons()
    {
        return $this->belongsToMany('Histoweb\Entities\Reason');
    }

    public function systemRevisions()
    {
        return $this->belongsToMany('Histoweb\Entities\SystemRevision');
    }

    public function procedures()
    {
        return $this->belongsToMany('Histoweb\Entities\Procedure');
    }

    public function diary()
    {
        return $this->belongsTo('Histoweb\Entities\Diary');
    }
    
}
