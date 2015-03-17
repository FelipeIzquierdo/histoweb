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
	            'updated_at'    => new DateTime 
	        ));
	    }
	}
?>