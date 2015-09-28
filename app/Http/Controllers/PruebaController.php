<?php namespace Histoweb\Http\Controllers;

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;
use OpenTok\Session;
use OpenTok\Role;

class PruebaController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		// Muaz Khan     - www.MuazKhan.com 
		// MIT License   - https://www.webrtc-experiment.com/licence/
		// Documentation - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/RecordRTC
		foreach(array('video', 'audio') as $type) {
		    if (isset($_FILES["${type}-blob"])) {
		    
		        echo 'uploads/';
		        
				$fileName = $_POST["${type}-filename"];
		        $uploadDirectory = 'uploads/'.$fileName;
		        
		        if (!move_uploaded_file($_FILES["${type}-blob"]["tmp_name"], $uploadDirectory)) {
		            echo(" problem moving uploaded file");
		        }
				
				echo($fileName);
		    }
		}

	}

	public function delete()
	{
		echo 'hola';
	}
}
