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
				'name' 			=> 'admin',
				'description'	=> 'Administrador'
			],
			[
				'name' 			=> 'reception',
				'description'	=> 'Recepcción'
			],
			[
				'name' 			=> 'doctor',
				'description'	=> 'Medico'
			],
			[
				'name' 			=> 'invitado',
				'description'	=> 'Invitado'
			],
			[
				'name' 			=> 'Centro médico',
				'description'	=> 'centro'
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