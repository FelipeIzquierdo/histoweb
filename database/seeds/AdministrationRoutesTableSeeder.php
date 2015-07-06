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
				'description'	=> ''
			],
			[
				'name' 			=> 'Sublingual',
				'description'	=> ''
			],
			[
				'name' 			=> 'Rectal',
				'description'	=> ''
			],
		];
		
		public function run()
	    {
	    	foreach (self::$route as $type) {
	    		AdministrationRoute::create([
	                'name'			=> $type['name'],
	                'description'	=> $type['description']
	            ]);
	    	}
	    }
	}
?>