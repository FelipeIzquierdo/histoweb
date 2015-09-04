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
        $session_id = $session->getSessionId();

        // Set some options in a token
        $token = $session->generateToken(array(
        'role'       => Role::MODERATOR,
        'expireTime' => time()+(7 * 24 * 60 * 60), // in one week
        'data'       => 'name=Felipe'
        ));

        $session_id ='2_MX40NTMwNTQ2Mn5-MTQ0MTM0MjY1MTg1OH5IeEMzdFBUS3RJNlFPWTVTS1FMNHhTUUN-UH4';
        $token = 'T1==cGFydG5lcl9pZD00NTMwNTQ2MiZzaWc9YjJmNWMwMjhiNTBiOTcwZDlhMmYxYzRiMmZlNDRjYTRhMTJhNDhlOTpzZXNzaW9uX2lkPTJfTVg0ME5UTXdOVFEyTW41LU1UUTBNVE0wTWpZMU1UZzFPSDVJZUVNemRGQlVTM1JKTmxGUFdUVlRTMUZNTkhoVFVVTi1VSDQmY3JlYXRlX3RpbWU9MTQ0MTM0MjUyOCZyb2xlPW1vZGVyYXRvciZub25jZT0xNDQxMzQyNTI4LjM4MDkyNzI1NDc2MDcmZXhwaXJlX3RpbWU9MTQ0MTk0NzMyOCZjb25uZWN0aW9uX2RhdGE9bmFtZSUzREZlbGlwZQ==';
        
		$view->with([
            'api_key'           => $api_key,
            'session_id'        => $session_id,
            'token'             => $token
        ]);
    }
 
}