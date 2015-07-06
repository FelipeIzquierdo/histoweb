<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Unit;
	/**
	* 
	*/
	class UnitsTableSeeder extends Seeder
	{

		private static $units = [
			[
				'name' 			=> 'mg'
			],
			[
				'name' 			=> 'gr'
			],
			[
				'name' 			=> 'Cucharada mediana'
			],
		];
		
		public function run()
	    {
	    	foreach (self::$units as $type) {
	    		Unit::create([
	                'name'			=> $type['name']
	            ]);
	    	}
	    }
	}
?>