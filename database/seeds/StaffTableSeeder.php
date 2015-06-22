<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Staff;
	/**
	* 
	*/
	class StaffTableSeeder extends Seeder
	{

		public function run()
	    {
	    	 Staff::create([
                'name'	=> 'Julio Naranjas',
                'description' => 'intrumentador',
                'code'	=>  1,
            ]);



	    }
	}
?>