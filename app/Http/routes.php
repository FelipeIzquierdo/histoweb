<?php 
use Histoweb\Entities\Doctor;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('tools', 'ToolsController');
Route::resource('surgeries', 'SurgeriesController');

Route::resource('specialties', 'SpecialtiesController');
Route::resource('doctors', 'DoctorsController');
Route::resource('doctors.availabilities', 'DoctorsAvailabilitiesController');
