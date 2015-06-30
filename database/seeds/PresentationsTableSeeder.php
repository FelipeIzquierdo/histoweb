<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Presentation;
	/**
	* 
	*/
	class PresentationsTableSeeder extends Seeder
	{

		private static $presentations = [
			[
				'name' 			=> 'Jarabe',
				'description'	=> ''
			],
			[
				'name' 			=> 'Tableta',
				'description'	=> ''
			],
			[
				'name' 			=> 'Pomada',
				'description'	=> ''
			],
		];
		
		public function run()
	    {
	    	foreach (self::$presentations as $type) {
	    		Presentation::create([
	                'name'			=> $type['name'],
	                'description'	=> $type['description'],
	                
	            ]);
	    	}
	    }
	}
?>