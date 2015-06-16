<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Implementer;
	/**
	* 
	*/
	class ImplemeterTableSeeder extends Seeder
	{

		public function run()
	    {
	    	 Implementer::create([
                'name'	=> 'Julio Naranjas',
                'description' => 'intrumentador',
                'code'	=>  1,
            ]);



	    }
	}
?>