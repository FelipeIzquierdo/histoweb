<?php namespace Histoweb\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use Histoweb\Entities\Reason;
use Histoweb\Entities\SystemRevision;
use Histoweb\Entities\Procedure;
use Histoweb\Entities\Disease;
use Histoweb\Entities\HistoryType;

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;
use OpenTok\Session;
use OpenTok\Role;

class AssistanceComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->reasons = Reason::allLists();
		$this->systemRevisions = SystemRevision::allLists();
		$this->procedures = Procedure::allLists();
		$this->diseases = Disease::allLists();
		$this->historyTypes = HistoryType::withHistories();

        $api_key = '45305462';
        $apiSecret = 'ce742d372c136fed8b3a488bb6904e36f8970dec';
        $opentok = new OpenTok($api_key, $apiSecret);
        
        $session = $opentok->createSession();
        
        $session_id ='1_MX40NTMwNTQ2Mn5-MTQ0MDAxNzE3MDYyN34xdU9OaFdRRW91WWt4cHZDa0tBdTFpMzd-UH4';
        $token = 'T1==cGFydG5lcl9pZD00NTMwNTQ2MiZzaWc9ZTRjMzdkNWEyYWNlNWNhYWEwYzA1MjFjZTA0NGQwZDhhYzQwNzMxMzpzZXNzaW9uX2lkPTFfTVg0ME5UTXdOVFEyTW41LU1UUTBNREF4TnpFM01EWXlOMzR4ZFU5T2FGZFJSVzkxV1d0NGNIWkRhMHRCZFRGcE16ZC1VSDQmY3JlYXRlX3RpbWU9MTQ0MDAxNzE3MCZyb2xlPW1vZGVyYXRvciZub25jZT0xNDQwMDE3MTcwLjc3NzMxNjg0OTQzMDczJmV4cGlyZV90aW1lPTE0NDA2MjE5NzAmY29ubmVjdGlvbl9kYXRhPW5hbWUlM0RGZWxpcGU=';

		$view->with([
            'reasons'			=> $this->reasons,
			'system_revisions'	=> $this->systemRevisions,
			'procedures'		=> $this->procedures,
			'diseases'			=> $this->diseases,
			'historyTypes'		=> $this->historyTypes,
            'api_key'           => $api_key,
            'session_id'        => $session_id,
            'token'             => $token
        ]);
    }
 
}