<?php  
	/**
	* 
	*/
	use Illuminate\Database\Seeder;
	use Illuminate\Database\Eloquent\Model;
	class UserTableSeeder extends Seeder
	{
		public function run()
	    {
	        DB::table('users')->insert(array(
	            'name'          => 	'Admin',
	            'email'         => 	'admin@histowebco.com',
	            'role_id'		=> 	1,
	            'office_type'	=>	'Histoweb\Staff',
	            'office_id'		=>	4,	
	            'password'      => 	Hash::make('123'),
	            'created_at'    => 	new DateTime,
	            'updated_at'    => 	new DateTime
	        ));

	        DB::table('users')->insert(array(
	            'name'          => 	'Recepcionista',
	            'email'         => 	'recepcion@histowebco.com',
	            'role_id'		=> 	2, 
	            'office_type'	=>	'Histoweb\Entities\Staff',
	            'office_id'		=>	3,	
	            'password'      =>  Hash::make('123'),
	            'created_at'    => 	new DateTime,
	            'updated_at'    => 	new DateTime
	        ));

	        DB::table('users')->insert(array(
	            'name'          => 	'Medico',
	            'email'         =>	'medico@histowebco.com',
	            'role_id'		=> 	3,
	            'office_type'	=>	'Histoweb\Entities\Doctor',
	            'office_id'		=>	1,	
	            'password'      =>  Hash::make('123'),
	            'created_at'    => 	new DateTime,
	            'updated_at'    => 	new DateTime
	        ));

	        DB::table('users')->insert(array(
	            'name'          => 'Invitado',
	            'email'         => 'invitado@histowebco.com',
            	'password'      =>  Hash::make('123'),
	            'created_at'    => new DateTime,
	            'updated_at'    => new DateTime,
	            'role_id'		=> '4' 
	        ));
	    }
	}
?>