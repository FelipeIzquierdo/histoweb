<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\GenericMedication;
	/**
	* 
	*/
	class GenericMedicationsTableSeeder extends Seeder
	{

		private static $generic = [
			[
				'cod' 			=> 'A10',
				'name' 			=> 'Acetaminofén',
				'description'	=> ''
			],
		];
		
		public function run()
	    {
	    	foreach (self::$generic as $type) {
	    		GenericMedication::create([
	    			'cod'			=> $type['cod'],
	                'name'			=> $type['name'],
	                'description'	=> $type['description']
	            ]);
	    	}
	    }
	}
?>