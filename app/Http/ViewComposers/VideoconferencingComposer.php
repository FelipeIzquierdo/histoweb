<?php namespace Histoweb\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;
use OpenTok\Session;
use OpenTok\Role;

class VideoconferencingComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $api_key = '45305462';
        $apiSecret = 'ce742d372c136fed8b3a488bb6904e36f8970dec';
        $opentok = new OpenTok($api_key, $apiSecret);
        
        $session = $opentok->createSession();
        //$session_id = $session->getSessionId();
        //$token = $opentok->generateToken($session_id);
        $session_id ='';
        $token = '';
		$view->with([
            'api_key'           => $api_key,
            'session_id'        => $session_id,
            'token'             => $token
        ]);
    }
 
}