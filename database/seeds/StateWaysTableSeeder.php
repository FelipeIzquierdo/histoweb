<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\StateWay;
	/**
	* 
	*/
	class StateWaysTableSeeder extends Seeder
	{

		public function run()
	    { 	 


	    	 StateWay::create([
                'name'	=> 'Limpia',
                'description' => 'Limpia',
                'code'	=>  1,
            ]);

	    	 StateWay::create([
                'name'	=> 'Contaminada',
                'description' => 'Contaminada',
                'code'	=>  2,
            ]);

	    	 StateWay::create([
                'name'	=> 'Sucia',
                'description' => 'Sucia',
                'code'	=>  3,
            ]);
	    }
	}
?>