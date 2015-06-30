<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests;
use Histoweb\Http\Requests\WayEntry\CreateRequest;
use Histoweb\Http\Requests\WayEntry\EditRequest;
use Histoweb\Entities\WayEntry;
use Illuminate\Http\Request;
use Histoweb\Http\Controllers\Controller;
use Response;
use Flash;
use Schema;
use Illuminate\Routing\Route;

class WayEntryController extends Controller
{
	private $wayEntry;
	private static $prefixRoute = 'admin.system.wayEntries.';
	private static $prefixView = 'dashboard.pages.admin.system.wayEntries.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findWayEntry', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	public function findWayEntry(Route $route)
	{
		$this->wayEntry = WayEntry::findOrFail($route->getParameter('wayEntries'));
	}



	/**
	 * Display a listing of the Post.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$query = WayEntry::query();
        $columns = Schema::getColumnListing('$TABLE_NAME$');
        $attributes = array();

        foreach($columns as $attribute){
            if($request[$attribute] == true)
            {
                $query->where($attribute, $request[$attribute]);
                $attributes[$attribute] =  $request[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        $wayEntries = $query->get();

        return view(self::$prefixView . 'index')
            ->with('wayEntries', $wayEntries)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new WayEntry.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view(self::$prefixView . 'create');
	}

	/**
	 * Store a newly created WayEntry in storage.
	 *
	 * @param CreateWayEntryRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $input = $request->all();

		$wayEntry = WayEntry::create($input);

		Flash::message('WayEntry saved successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}

	/**
	 * Display the specified WayEntry.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		if(empty($this->wayEntry))
		{
			Flash::error('WayEntry not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		return view(self::$prefixView . 'show')->with('wayEntry', $this->wayEntry);
	}

	/**
	 * Show the form for editing the specified WayEntry.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{		

		if(empty($this->wayEntry))
		{
			Flash::error('WayEntry not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		return view(self::$prefixView . 'edit')->with('wayEntry', $this->wayEntry);
	}

	/**
	 * Update the specified WayEntry in storage.
	 *
	 * @param  int    $id
	 * @param CreateWayEntryRequest $request
	 *
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
		/** @var WayEntry $wayEntry */
		

		if(empty($this->wayEntry))
		{
			Flash::error('WayEntry not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->wayEntry->fill($request->all());
		$this->wayEntry->save();

		Flash::message('WayEntry updated successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}

	/**
	 * Remove the specified WayEntry from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var WayEntry $wayEntry */
		

		if(empty($this->wayEntry))
		{
			Flash::error('WayEntry not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->wayEntry->delete();

		Flash::message('WayEntry deleted successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}
}
