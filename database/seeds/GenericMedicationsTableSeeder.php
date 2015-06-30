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
				'description'	=> '',
				'administration_route_presentation_id' => 1,
			],
			[
				'cod' 			=> 'A11',
				'name' 			=> 'Ácido acético',
				'description'	=> '',
				'administration_route_presentation_id' => 2,
			],
			[
				'cod' 			=> 'A12',
				'name' 			=> 'Ácido Acetilsalicílico',
				'description'	=> '',
				'administration_route_presentation_id' => 3,
			],
		];
		
		public function run()
	    {
	    	foreach (self::$generic as $type) {
	    		GenericMedication::create([
	    			'cod'			=> $type['cod'],
	                'name'			=> $type['name'],
	                'description'	=> $type['description'],
	                'administration_route_presentation_id'=> $type['administration_route_presentation_id'],
	            ]);
	    	}
	    }
	}
?>