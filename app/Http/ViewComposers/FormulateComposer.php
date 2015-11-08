<?php namespace Histoweb\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;

use Histoweb\Entities\Presentation;
use Histoweb\Entities\GenericMedication;
use Histoweb\Entities\Unit;
use Histoweb\Entities\Diluent;
use Histoweb\Entities\Concentration;
use Histoweb\Entities\CommercialMedication;
use Histoweb\Entities\AdministrationRoute;
 
class FormulateComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->administration_routes    = AdministrationRoute::allLists();
        $this->units                    = Unit::allLists();
        $this->generic_medications      = GenericMedication::allLists();
        $this->diluents                 = Diluent::allLists();
        $this->concentrations           = Concentration::get();

        $view->with([
            'generic_medications'    => $this->generic_medications,
            'diluents'               => $this->diluents,
            'units'                  => $this->units,
            'administration_routes'  => $this->administration_routes,
        ]);
    }
 
}