<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\CommercialMedication;
	/**
	* 
	*/
	class CommercialMedicationsTableSeeder extends Seeder
	{

		private static $commercial = [
			[
				'cod' 			=> 'A10',
				'name' 			=> 'Norsina',
				'description'	=> '',
				'generic_medication_id'	=> 1,
				'lab_id'	=> 1,
			],
			[
				'cod' 			=> 'A11',
				'name' 			=> 'Acetafen Forte',
				'description'	=> '',
				'generic_medication_id'	=> 1,
				'lab_id'	=> 2,
			],
			[
				'cod' 			=> 'A12',
				'name' 			=> 'Aspirina',
				'description'	=> '',
				'generic_medication_id'	=> 3,
				'lab_id'	=> 1,
			],
		];
		
		public function run()
	    {
	    	foreach (self::$commercial as $type) {
	    		CommercialMedication::create([
	    			'cod'			=> $type['cod'],
	                'name'			=> $type['name'],
	                'description'	=> $type['description'],
	                'generic_medication_id'	=> $type['generic_medication_id'],
	                'lab_id'			=> $type['lab_id'],
	            ]);
	    	}
	    }
	}
?>