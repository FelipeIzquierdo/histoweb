<?php namespace Histoweb\Http\Controllers\Admin;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller {

	/**
	 * Display a listing of functions that admin can execute
	 *
	 * @return Response
	 */
	public function getIndex()
	{		
		if(Auth::user()->hasRol('doctor'))
		{
			return redirect()->to('assistance');
		}
		else if(Auth::user()->hasRol('reception'))
		{
			return redirect()->to('reception');
		}

		return view('dashboard.pages.admin.home');
	}

}
