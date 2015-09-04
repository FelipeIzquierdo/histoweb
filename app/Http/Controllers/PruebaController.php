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
		$api_key = '45305462';
		$apiSecret = 'ce742d372c136fed8b3a488bb6904e36f8970dec';
		$opentok = new OpenTok($api_key, $apiSecret);
		
		$session = $opentok->createSession();
		$session_id = '';
		$token = '';


		return view('pruebaa')
				->with(['api_key' => $api_key,
						'session_id' => $session_id,
						'token' => $token
						]);
	}

	public function createsession($opentok)
	{
		// Create a session that attempts to use peer-to-peer streaming:
		$session = $opentok->createSession();

		// A session that uses the OpenTok Media Router:
		$session = $opentok->createSession(array( 'mediaMode' => MediaMode::ROUTED ));

		// A session with a location hint:
		$session = $opentok->createSession(array( 'location' => '12.34.56.78' ));

		// An automatically archived session:
		$sessionOptions = array(
		    'archiveMode' => ArchiveMode::ALWAYS,
		    'mediaMode' => MediaMode::ROUTED
		);
		$session = $opentok->createSession($sessionOptions);

		return $session;
	}

	public function generateToken($opentok,$session)
	{
		// Generate a Token from just a session_id (fetched from a database)
		$token = $opentok->generateToken($session->getSessionId());
		
		$token = $session->generateToken();

		// Set some options in a token
		$token = $session->generateToken(array(
		    'role'       => Role::MODERATOR,
		    'expireTime' => time()+(7 * 24 * 60 * 60), // in one week
		    'data'       => 'name=Felipe'
		));
		return $token;
	}
}
