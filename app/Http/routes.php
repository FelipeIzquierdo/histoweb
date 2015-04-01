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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
	
	Route::group(['prefix' => 'system', 'namespace' => 'System'], function() {
		Route::resource('diary-types', 'DiaryTypesController');
		Route::resource('tools', 'ToolsController');
		Route::resource('specialties', 'SpecialtiesController');
		Route::controller('/', 'SystemController', ['getIndex' => 'admin.system']);
	});

	Route::group(['prefix' => 'company', 'namespace' => 'Company'], function() {
		Route::resource('patients', 'PatientsController');

		Route::group(['namespace' => 'Surgery'], function() {
			Route::resource('surgeries.schedules', 'SurgeriesSchedulesController');
			Route::resource('surgeries.diaries', 'SurgeriesDiariesController');


Route::resource('doctors.diaries', 'DoctorsDiariesController');
Route::get('doctors/{doctors}/diaries-json', ['uses' => 'DoctorsDiariesController@json', 'as' => 'doctors.diaries.json']);

			Route::group(['prefix' => 'surgeries'], function() {
				Route::get('{surgeries}/schedules-json', ['uses' => 'SurgeriesSchedulesController@json', 'as' => 'admin.company.surgeries.schedules.json']);
				Route::post('{surgeries}/schedules-massive', ['uses' => 'SurgeriesSchedulesController@storeMassive', 'as' => 'admin.company.surgeries.schedules.storeMassive']);
				Route::post('{surgeries}/availabilities/{availabilities}', ['uses' => 'SurgeriesSchedulesController@discard', 'as' => 'admin.company.surgeries.schedules.discard']);
				
				Route::get('{surgeries}/diaries-json', ['uses' => 'SurgeriesDiariesController@json', 'as' => 'admin.company.surgeries.diaries.json']);
			});


			Route::resource('surgeries', 'SurgeriesController');
		});

		Route::group(['namespace' => 'Doctor'], function() {
			Route::resource('doctors.availabilities', 'DoctorsAvailabilitiesController');
			Route::resource('doctors.schedules', 'DoctorsSchedulesController');
			Route::resource('doctors.diaries', 'DoctorsDiariesController', ['only' => 'index', 'json']);

			Route::group(['prefix' => 'doctors'], function() {
				Route::get('{doctors}/availabilities-json', ['uses' => 'DoctorsAvailabilitiesController@json', 'as' => 'admin.company.doctors.availabilities.json']);
				Route::get('{doctors}/schedules-json', ['uses' => 'DoctorsSchedulesController@json', 'as' => 'admin.company.doctors.schedules.json']);
				Route::get('{doctors}/diaries-json', ['uses' => 'DoctorsDiariesController@json', 'as' => 'admin.company.doctors.diaries.json']);
			});

			Route::resource('doctors', 'DoctorsController');
		});

		Route::controller('/', 'CompanyController', ['getIndex' => 'admin.company']);
	});

	Route::controller('/', 'AdminController', ['getIndex' => 'admin']);
});
