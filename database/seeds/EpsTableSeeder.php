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
	    	Eps::create([
                'name'	=> 'Nueva EPS',
                'code'	=>  1
            ]);

            Eps::create([
                'name'	=> 'Coomeva',
                'code'	=>  2
            ]);

	    }
	}
?>