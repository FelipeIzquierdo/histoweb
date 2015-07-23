<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
	protected $table = 'entries';
	protected $fillable = ['diary_id', 'present_illness', 'management_plan'];

	public $timestamps = true;
	public $increments = true;

    private static $routePdfHistoryClinic = '/documents/historyClinic/';

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

        $new_reason_ids = $this->syncNewReasons($data['new_reasons']);
        if(array_key_exists('reasons', $data))
        {
            $all_reason_ids = array_merge($data['reasons'] , $new_reason_ids);
            $this->reasons()->sync($all_reason_ids);
        }
        
        $new_system_revisions_ids = $this->syncNewSystemRevisions($data['new_system_revisions']);
        if(array_key_exists('system_revisions', $data))
        {
            $all_system_revisions_ids = array_merge($data['system_revisions'] ,$new_system_revisions_ids);
            $this->systemRevisions()->sync($all_system_revisions_ids);
        }
        
        if(array_key_exists('procedures', $data))
        {
            $this->procedures()->sync($data['procedures']);
        }

        if(array_key_exists('diseases', $data))
        {
            $this->diseases()->sync($data['diseases']);
        }
    } 

    public function syncNewReasons($newReasons)
    {   
        if (!empty($newReasons)) 
        {
            $newReasons = explode(",", $newReasons);
            return $this->saveNewReasons($newReasons);
        }
        return [];
    }

    public function saveNewReasons($reasons)
    {
        $reason_ids = [];
        foreach ($reasons as $name) {
            $reason = Reason::firstOrNew(['name' => $name]);
            $this->reasons()->save($reason);
            array_push($reason_ids, $reason->id);
        }
        return $reason_ids;
    }

    public function syncNewSystemRevisions($newSystemRevisions)
    {
        if (!empty($newSystemRevisions)) 
        {
            $newSystemRevisions = explode(",", $newSystemRevisions);
            return $this->saveNewSystemRevisions($newSystemRevisions);
        }
        return [];
    }

    public function saveNewSystemRevisions($systemRevisions)
    {
        $system_revision_ids = [];
        foreach ($systemRevisions as $name) {
            $systemRevision = SystemRevision::firstOrNew(['name' => $name]);
            $this->systemRevisions()->save($systemRevision);
            array_push($system_revision_ids, $systemRevision->id );
        }
        return $system_revision_ids;
    }

    public function getSaveExit()
    {
        $data_time = new \DateTime(); 
        $this->exit_at = $data_time->format('Y-m-d H:i:s');
        $this->save();
    }
    public function getHistoryPdf()
    {
        return self::$routePdfHistoryClinic . $this->id . '.pdf';
    }

    public function getOrderProcedures()
    {
        return $this->orderProcedures->sortByDesc('updated_at');
    }

    public function getDescribeProcedures()
    {
        return $this->describeProcedures->sortByDesc('updated_at');
    }

    public function reasons()
    {
        return $this->belongsToMany('Histoweb\Entities\Reason')->withTimestamps();
    }

    public function systemRevisions()
    {
        return $this->belongsToMany('Histoweb\Entities\SystemRevision')->withTimestamps();
    }

    public function procedures()
    {
        return $this->belongsToMany('Histoweb\Entities\Procedure')->withTimestamps();
    }

    public function diseases()
    {
        return $this->belongsToMany('Histoweb\Entities\Disease')->withTimestamps();
    }

    public function diary()
    {
        return $this->belongsTo('Histoweb\Entities\Diary');
    }

    public function formulates()
    {
        return $this->hasMany('Histoweb\Entities\Formulate');
    }

    public function orderProcedures()
    {
        return $this->hasMany('Histoweb\Entities\OrderProcedure');
    }

    public function describeProcedures()
    {
        return $this->hasMany('Histoweb\Entities\DescribeProcedure');
    }
    
}
