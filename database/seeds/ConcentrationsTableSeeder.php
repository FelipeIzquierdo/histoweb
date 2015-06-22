<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Concentration;
	/**
	* 
	*/
	class ConcentrationsTableSeeder extends Seeder
	{

		private static $concentrations = [
			[
				'name' 			=> 'Miligramos',
				'value'			=> 1
			],
			[
				'name' 			=> 'Gramos',
				'value'			=> 0.001
			],
			[
				'name' 			=> 'Cucharada mediana',
				'value'			=> 500
			],
			[
				'name' 			=> 'Centimetros cúbicos (cc)',
				'value'			=> 500
			],
		];
		
		public function run()
	    {
	    	foreach (self::$concentrations as $type) {
	    		Concentration::create([
	                'name'			=> $type['name'],
	                'value'			=> $type['value']
	            ]);
	    	}
	    }
	}
?>