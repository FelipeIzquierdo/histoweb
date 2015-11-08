<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Role;
	/**
	* 
	*/
	class RolesTableSeeder extends Seeder
	{

		private static $roles = [
			[
				'name' 			=> 'Administrador'
			],
			[
				'name' 			=> 'Recepcion'
			],
			[
				'name' 			=> 'Medico'
			],
		];
		
		public function run()
	    {
	    	foreach (self::$roles as $type) {
	    		Role::create([
	                'name'			=> $type['name']
	            ]);
	    	}
	    }
	}
?>