<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Diluent;
	/**
	* 
	*/
	class DiluentsTableSeeder extends Seeder
	{

		private static $diluents = [
			[
				'name' 			=> 'cc'
			]
		];
		
		public function run()
	    {
	    	foreach (self::$diluents as $type) {
	    		Diluent::create([
	                'name'			=> $type['name']
	            ]);
	    	}
	    }
	}
?>