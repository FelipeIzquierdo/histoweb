<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Path for classes
	|--------------------------------------------------------------------------
	|
	| All Classes will be created on these relevant path
	|
	*/

	'path_migration'           => base_path('database/migrations/'),

	'path_model'               => app_path('Entities/'),

	'path_repository'          => app_path('Libraries/Repositories/'),

	'path_controller'          => app_path('Http/Controllers/'),

	'path_api_controller'      => app_path('Http/Controllers/API/'),

	'path_views'               => base_path('resources/views'),

	'path_request'             => app_path('Http/Requests/'),

	'path_routes'              => app_path('Http/routes.php'),


	/*
	|--------------------------------------------------------------------------
	| Namespace for classes
	|--------------------------------------------------------------------------
	|
	| All Classes will be created with these namespaces
	|
	*/

	'namespace_model'          => 'Histoweb\Entities',

	'namespace_repository'     => 'Histoweb\Libraries\Repositories',

	'namespace_controller'     => 'Histoweb\Http\Controllers',

	'namespace_api_controller' => 'Histoweb\Http\Controllers\API',

	'namespace_request'        => 'Histoweb\Http\Requests',

	/*
	|--------------------------------------------------------------------------
	| Model extend
	|--------------------------------------------------------------------------
	|
	| Model extend Configuration.
	| By default Eloquent model will be used.
	| If you want to extend your own custom model then you can specify "model_extend" => true and "model_extend_namespace" & "model_extend_class".
	|
	| e.g.
	| 'model_extend' => true,
	| 'model_extend_namespace' => 'App\Models\AppBaseModel as AppBaseModel',
	| 'model_extend_class' => 'AppBaseModel',
	|
	*/

	'model_extend'             => false,

	'model_extend_namespace'   => 'Illuminate\Database\Eloquent\Model',

	'model_extend_class'       => 'Model',

	/*
	|--------------------------------------------------------------------------
	| API routes prefix
	|--------------------------------------------------------------------------
	|
	| By default "api" will be prefix
	|
	*/

	'api_prefix'               => 'api',
];
