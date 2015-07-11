<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Concentration;
	/**
	* 
	*/
	class ConcentrationsTableSeeder extends Seeder
	{

		private static $concentration = [
			[
				'generic_medication_id' => 1,
				'presentation_id' 		=> 2,
				'unit_id'				=> 1,
				'unit_amount' 			=> 500,
				'diluent_id'			=> 1,
				'diluent_amount' 		=> 1

			]
		];
		
		public function run()
	    {
	    	foreach (self::$concentration as $type) {
	    		Concentration::create([
	    			'generic_medication_id'			=> $type['generic_medication_id'],
	                'presentation_id'			=> $type['presentation_id'],
	                'unit_id'	=> $type['unit_id'],
	                'unit_amount'	=> $type['unit_amount'],
	                'diluent_id'	=> $type['diluent_id'],
	                'diluent_amount'	=> $type['diluent_amount']
	            ]);
	    	}
	    }
	}
?>