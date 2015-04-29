<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\HistoryType;
	/**
	* 
	*/
	class HistoryTypesTableSeeder extends Seeder
	{
		private static $historyTypes = [
			[
				'name_system' 	=> 'medical_history', 
				'name' 			=> 'Antecedentes médicos',
				'news'			=> false
			],
			[
				'name_system' 	=> 'surgical_history', 
				'name' 			=> 'Antecedentes quirurgicos',
				'news'			=> true
			],
			[
				'name_system' 	=> 'traumatic_history', 
				'name' 			=> 'Antecedentes traumaticos',
				'news'			=> true
			],
			[
				'name_system' 	=> 'toxic_allergic_history', 
				'name' 			=> 'Antecedentes toxicos y alergicos',
				'news'			=> true
			],
			[
				'name_system' 	=> 'reproductive_history', 
				'name' 			=> 'Antecedentes ginecoobstetricos',
				'news'			=> true
			]
		];
		
		public function run()
	    {
	    	foreach (self::$historyTypes as $type) {
	    		HistoryType::create([
	                'name_system'	=> $type['name_system'],
	                'name'			=> $type['name'],
	                'news'			=> $type['news']
	            ]);
	    	}
	    }
	}
?>