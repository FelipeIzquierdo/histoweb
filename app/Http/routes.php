<?php 
use Histoweb\Entities\Surgery;
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

Route::get('deprueba', function(){
	$surgery = Surgery::find(1);
	dd($surgery->diaries);
});


Route::group(['prefix' => 'assistance', 'namespace' => 'Assistance'], function() {

	Route::get('options/{one}/formulate/create', ['uses' => 'FormulateController@create', 'as' => 'assistance.options.formulate.create']);
	Route::post('options/{one}/formulate/create', ['uses' => 'FormulateController@store', 'as' => 'assistance.options.formulate.store']);
	Route::get('options/{one}/formulate/{two}/edit', ['uses' => 'FormulateController@edit', 'as' => 'assistance.options.formulate.edit']);
	Route::post('options/{one}/formulate/{two}/edit', ['uses' => 'FormulateController@update', 'as' => 'assistance.options.formulate.update']);

	Route::get('options/{one}/order-procedures/create', ['uses' => 'OrderProceduresController@create', 'as' => 'assistance.options.order-procedures.create']);
	Route::post('options/{one}/order-procedures/create', ['uses' => 'OrderProceduresController@store', 'as' => 'assistance.options.order-procedures.store']);
	Route::get('jsonProcedure/{id}', 'OrderProceduresController@jsonProcedure');

	Route::post('options/{one}/removeprocedure', ['uses' => 'AssistanceController@getRemoveProcedure', 'as' => 'assistance.entries.removeprocedure']);
	Route::controller('/', 'AssistanceController', [
		'getIndex' 			=> 'assistance', 
		'getEntries' 		=> 'assistance.entries',
		'getExit'	 		=> 'assistance.exit',
		'getHistory'		=> 'assistance.entries.history',
		'postHistory'		=> 'assistance.entries.history',
		'getOptions'		=> 'assistance.entries.options',
		'getPdf'			=> 'assistance.entries.pdf',
	]);
});

Route::group(['prefix' => 'reception', 'namespace' => 'Reception', 'middleware' => 'auth'], function() {
	Route::controller('/', 'ReceptionController', [
		'getIndex' => 'reception',
		'postActivateDiary' => 'reception.activate-diary'
	]);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
	
	Route::group(['prefix' => 'system', 'namespace' => 'System'], function() {

		Route::resource('diary-types', 'DiaryTypesController');
		Route::resource('diagnoses', 'DiagnosesController');
		Route::resource('histories', 'HistoriesController');
		Route::resource('history-types', 'HistoryTypesController');
		Route::resource('memberships', 'MembershipsController');
		Route::resource('procedures', 'ProceduresController');
		Route::resource('procedure-types', 'ProcedureTypeController');
		Route::resource('reasons', 'ReasonsController');
		Route::resource('tools', 'ToolsController');
		Route::resource('specialties', 'SpecialtiesController');
		Route::resource('system-revisions', 'SystemRevisionsController');
        Route::resource('eps', 'EpsController');

		Route::group(['prefix' => 'medicament', 'namespace' => 'Medicament'], function() {

			Route::resource('inventaries', 'InventariesController');
			Route::resource('measures', 'MeasuresController');
			Route::resource('medicaments', 'MedicamentsController');
			Route::resource('presentations', 'PresentationsController');
			Route::resource('via-medicaments', 'ViaMedicamentsController');

			Route::controller('/', 'MedicamentController', ['getIndex' => 'admin.system.medicament']);

		});

		Route::controller('/', 'SystemController', ['getIndex' => 'admin.system']);

	});

	Route::group(['prefix' => 'company', 'namespace' => 'Company'], function() {
		Route::resource('patients', 'PatientsController');
        Route::get('patients/{doc}/find', ['uses' => 'PatientsController@find', 'as' => 'admin.company.patients.find']);

		Route::group(['namespace' => 'Surgery'], function() {
			Route::resource('surgeries.availabilities', 'SurgeriesAvailabilitiesController');
			Route::resource('surgeries.diaries', 'SurgeriesDiariesController');

			Route::group(['prefix' => 'surgeries'], function() {
				Route::get('{surgeries}/availabilities-json', ['uses' => 'SurgeriesAvailabilitiesController@json', 'as' => 'admin.company.surgeries.availabilities.json']);
				Route::post('{surgeries}/availabilities-massive', ['uses' => 'SurgeriesAvailabilitiesController@storeMassive', 'as' => 'admin.company.surgeries.availabilities.storeMassive']);
				Route::post('{surgeries}/availabilities/{availabilities}', ['uses' => 'SurgeriesAvailabilitiesController@discard', 'as' => 'admin.company.surgeries.availabilities.discard']);
				
				Route::get('{surgeries}/diaries-json', ['uses' => 'SurgeriesDiariesController@json', 'as' => 'admin.company.surgeries.diaries.json']);
			});


			Route::resource('surgeries', 'SurgeriesController');
		});

		Route::group(['namespace' => 'Doctor'], function() {
			Route::resource('doctors.availabilities', 'DoctorsAvailabilitiesController');
			Route::resource('doctors.diaries', 'DoctorsDiariesController');


			Route::group(['prefix' => 'doctors'], function() {
				Route::get('{doctors}/availabilities-json', ['uses' => 'DoctorsAvailabilitiesController@json', 'as' => 'admin.company.doctors.availabilities.json']);
				Route::get('{doctors}/diaries-json', ['uses' => 'DoctorsDiariesController@json', 'as' => 'admin.company.doctors.diaries.json']);
                Route::get('{doctors}/new-diary/{patients}/{diary_types}', ['uses' => 'DoctorsDiariesController@newDiary', 'as' => 'admin.company.doctors.diaries.new']);
			});

			Route::resource('doctors', 'DoctorsController');
		});

		Route::controller('/', 'CompanyController', ['getIndex' => 'admin.company']);
	});

	Route::controller('/', 'AdminController', ['getIndex' => 'admin']);
});
