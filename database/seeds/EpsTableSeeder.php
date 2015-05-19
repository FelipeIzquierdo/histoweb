<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Eps;
	/**
	* 
	*/
	class EpsTableSeeder extends Seeder
	{

		public function run()
	    {
	    	\DB::table('eps')->insert([
                'name'	=> 'Eps 1',
                'code'	=>  1
            ]);

	    }
	}
?>