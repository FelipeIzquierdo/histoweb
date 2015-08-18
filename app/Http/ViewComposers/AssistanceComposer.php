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
        
        $session_id ='2_MX40NTMwNTQ2Mn5-MTQzOTg1MzI4MTY0NH5tQUtPSXB6NnczK0JxOWozWk1MbVNKSWh-UH4';
        $token = 'T1==cGFydG5lcl9pZD00NTMwNTQ2MiZzaWc9MWRjZWVjODM5NGE3OTlmNzQyNmU1ZWFmMjYzMzljNjU2ZDgxZjM5MzpzZXNzaW9uX2lkPTJfTVg0ME5UTXdOVFEyTW41LU1UUXpPVGcxTXpJNE1UWTBOSDV0UVV0UFNYQjZObmN6SzBKeE9Xb3pXazFNYlZOS1NXaC1VSDQmY3JlYXRlX3RpbWU9MTQzOTg1MzI4MSZyb2xlPXB1Ymxpc2hlciZub25jZT0xNDM5ODUzMjgxLjc5MTIxOTg4MjQ4OTc4';

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