<?php namespace Histoweb\Http\Controllers\Reception;

use Histoweb\Entities\Doctor;
use Histoweb\Entities\Diary;
use Histoweb\Entities\DiaryType;
use Histoweb\Entities\DocType;
use Histoweb\Entities\Eps;
use Histoweb\Entities\MembershipType;
use Histoweb\Entities\Occupation;
use Histoweb\Entities\Patient;
use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ReceptionController extends Controller {

	private $patient;
	private $diary;

	/**
	 * Display a listing of functions that admin can execute
	 *
	 * @return Response
	 */

	public function getIndex()
	{
        $diaryTypes = DiaryType::allLists();
        $occupations = Occupation::allLists();
        $doc_types = DocType::allLists();
        $genders = Patient::$genders;
        $doctors = Doctor::allLists();
        $doctor = 1;
        $eps = Eps::allLists();
        $membershipTypes = MembershipType::allLists();
        
        $url = route('admin.company.doctors.diaries.json', 1);
        return view('dashboard.pages.reception.home', compact('doctors','url', 'diaryTypes','occupations', 'doc_types', 'genders', 'doctor','eps', 'membershipTypes'));
	}

	public function postCancelDiary(Request $request, $diary_id)
	{
		if($request->ajax())
		{  
			$diary = Diary::find($diary_id);        	
			$diary->delete();
    		 	
	        return response()->json([
	            'message' =>     'evento eliminado',
	        ]);
	    }
	}	

	public function postActivateDiary(Request $request, $diary_id)
	{
		if($request->ajax())
		{  
			$diary = Diary::find($diary_id); 
        	if(is_null($diary->entered_at))
    		{
    			$diary->entered_at = date('Y-m-d H:i:s');
    			$diary->save();
    		}  	
	        return response()->json([
	            'entered_at' =>     $diary->entered_at,
	        ]);
	    }
	}

}
