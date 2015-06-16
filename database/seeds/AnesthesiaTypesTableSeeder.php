<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\AnesthesiaType;
	/**
	* 
	*/
	class AnesthesiaTypesTableSeeder extends Seeder
	{

		public function run()
	    {
	    	 AnesthesiaType::create([
                'name'	=> 'Local',
                'description' => 'Local',
                'code'	=>  1,
            ]);

	    	 AnesthesiaType::create([
                'name'	=> 'Regional',
                'description' => 'Regional',
                'code'	=>  2,
            ]);

	    	 AnesthesiaType::create([
                'name'	=> 'Endovenosa',
                'description' => 'Endovenosa',
                'code'	=>  3,
            ]);



	    }
	}
?>