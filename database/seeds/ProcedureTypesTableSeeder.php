<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\ProcedureType;
	/**
	* 
	*/
	class ProcedureTypesTableSeeder extends Seeder
	{

		private static $procedure_types = [
			[
				'name' 			=> 'PUNCION',
				'description'	=> ''
			]
		];
		
		public function run()
	    {
	    	foreach (self::$procedure_types as $type) {
	    		ProcedureType::create([
	                'name'			=> $type['name'],
	                'description'	=> $type['description'],
	            ]);
	    	}
	    }
	}
?>