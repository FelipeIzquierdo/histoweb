<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\AdministrationRoute;
	/**
	* 
	*/
	class AdministrationRoutesTableSeeder extends Seeder
	{

		private static $route = [
			[
				'name' 			=> 'Oral',
				'description'	=> '',
				'presentation_id'	=> 1,
			],
			[
				'name' 			=> 'Sublingual',
				'description'	=> '',
				'presentation_id'	=> 2,
			],
			[
				'name' 			=> 'Rectal',
				'description'	=> '',
				'presentation_id'	=> 3,
			],
		];
		
		public function run()
	    {
	    	foreach (self::$route as $type) {
	    		AdministrationRoute::create([
	                'name'			=> $type['name'],
	                'description'	=> $type['description'],
	                'presentation_id'	=> $type['presentation_id'],
	            ]);
	    	}
	    }
	}
?>