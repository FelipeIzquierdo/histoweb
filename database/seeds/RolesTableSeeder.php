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
				'name' 			=> 'Administrador',
				'description'	=> ''
			],
			[
				'name' 			=> 'Recepción',
				'description'	=> ''
			],
			[
				'name' 			=> 'Médico',
				'description'	=> ''
			],
			[
				'name' 			=> 'Invitado',
				'description'	=> ''
			],
			[
				'name' 			=> 'Centro médico',
				'description'	=> ''
			],
		];
		
		public function run()
	    {
	    	foreach (self::$roles as $rol) {
	    		Role::create([
	                'name'			=> $rol['name'],
	                'description'	=> $rol['description']
	            ]);
	    	}
	    }
	}
?>