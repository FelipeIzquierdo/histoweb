<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Lab;
	/**
	* 
	*/
	class LabsTableSeeder extends Seeder
	{

		private static $labs = [
			[
				'cod' 			=> '19948063',
				'name' 			=> 'LABORATORIOS FARMACEUTICOS OPHALAC S.A.',
				'description'	=> ''
			],
			[
				'cod' 			=> '15678',
				'name' 			=> 'GENFAR S.A.',
				'description'	=> ''
			],
			[
				'cod' 			=> '19908973',
				'name' 			=> 'SANOFI-AVENTIS DE COLOMBIA S.A.',
				'description'	=> ''
			],
		];
		
		public function run()
	    {
	    	foreach (self::$labs as $type) {
	    		Lab::create([
	    			'cod'			=> $type['cod'],
	                'name'			=> $type['name'],
	                'description'	=> $type['description']
	            ]);
	    	}
	    }
	}
?>