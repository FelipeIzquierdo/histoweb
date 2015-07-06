<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\AdministrationRoutePresentation;
	/**
	* 
	*/
	class AdministrationRoutePresentationsTableSeeder extends Seeder
	{

		private static $route = [
			[
				'route_id' 	=> 1,
				'presentation_id'	=> 2
			],
			[
				'route_id' 	=> 2,
				'presentation_id'	=> 1
			],
			[
				'route_id' 	=> 2,
				'presentation_id'	=> 3
			],
		];
		
		public function run()
	    {
	    	foreach (self::$route as $type) {
	    		AdministrationRoutePresentation::create([
	                'route_id'			=> $type['route_id'],
	                'presentation_id'	=> $type['presentation_id']
	            ]);
	    	}
	    }
	}
?>