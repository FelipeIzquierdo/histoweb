<?php namespace Histoweb\Http\Controllers\Assistance;

use Histoweb\Components\Pdf\PdfBuilder as MyPdf;
use Histoweb\Entities\DescribeProcedure;
use Histoweb\Http\Requests\DescribeProcedure\CreateRequest;
use Histoweb\Entities\AnesthesiaType;
use Histoweb\Entities\Doctor;
use Histoweb\Entities\Entry;
use Histoweb\Entities\Staff;
use Histoweb\Entities\StateWay;
use Histoweb\Entities\Surgery;
use Histoweb\Entities\WayEntry;
use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;
use Illuminate\Routing\Route;


class DescribeProceduresController extends Controller {

    private $describe_procedure;
    private $entry;
    private $doctors;
    private $anesthesia_types;
    private $staff;
    private $way_entries;
    private $state_ways;
    private $surgeries;
    private static $prefixRoute = 'assistance.options.describeProcedures.';
    private static $prefixView = 'dashboard.pages.assistance.describeProcedures.';

    public function __construct()
    {
        $this->middleware('auth');
        $this->beforeFilter('@findLoadForm', ['only' => ['create','store']]);
    }


    public function findLoadForm(Route $route)
    {
        $this->entry = Entry::findOrFail($route->getParameter('one'));
        $this->doctors = Doctor::allListsAnesthesiologist();
        $this->anesthesia_types = AnesthesiaType::allLists();
        $this->staff = Staff::allListsImplementers();
        $this->way_entries = WayEntry::allLists();
        $this->state_ways = StateWay::allLists();
        $this->surgeries = Surgery::allLists();
    }

    public function create()
    {
        $form_data = ['route' => [self::$prefixRoute . 'store',$this->entry->id], 'method' => 'POST', 'id' => 'entryForm'];

        return view(self::$prefixView . 'form', compact('form_data'))
            ->with([
                'entry'             => $this->entry,
                'doctors'           => $this->doctors,
                'anesthesia_types'  => $this->anesthesia_types,
                'staff'             => $this->staff,
                'way_entries'       => $this->way_entries,
                'state_ways'        => $this->state_ways,
                'surgeries'         => $this->surgeries
            ]);
    }


    public function store(CreateRequest $request,$id)
    {
        $data = ['entry_id' => $this->entry->id]+$request->all();
        $this->describe_procedure = DescribeProcedure::create($data);
        $pdf = new MyPdf();
        $pdf->describeProcedurePdf($this->describe_procedure,$this->entry);
        return redirect()->route('assistance.entries.options', $id);
    }

}
