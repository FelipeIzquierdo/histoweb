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
	            'name'          => 'Admin',
	            'email'         => 'admin@histowebco.com',
	            'password'      =>  Hash::make('123'),
	            'created_at'    => new DateTime,
	            'updated_at'    => new DateTime,
	            'role_id'		=> '1' 
	        ));

	        DB::table('users')->insert(array(
	            'name'          => 'Recepcionista',
	            'email'         => 'recepcion@histowebco.com',
	            'password'      =>  Hash::make('123'),
	            'created_at'    => new DateTime,
	            'updated_at'    => new DateTime,
	            'role_id'		=> '2' 
	        ));

	        DB::table('users')->insert(array(
	            'name'          => 'Medico',
	            'email'         => 'medico@histowebco.com',
	            'password'      =>  Hash::make('123'),
	            'created_at'    => new DateTime,
	            'updated_at'    => new DateTime,
	            'role_id'		=> '3' 
	        ));

	    }
	}
?>