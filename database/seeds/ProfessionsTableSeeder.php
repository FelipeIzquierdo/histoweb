<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Profession;
	/**
	* 
	*/
	class ProfessionsTableSeeder extends Seeder
	{

		public function run()
	    {
	    	Profession::create([
                'name'	=> 'Ingeneria de Sistemas',
                'description' => 'Ingeniero de Sistema',
                'code'	=>  1,
            ]);

            Profession::create([
                'name'	=> 'Ingeneria  Mecanica',
                'description' => 'Ingeneria  Mecanica',
                'code'	=>  2,
            ]);

            Profession::create([
                'name'	=> 'Instrumentador',
                'description' => 'Instrumentador',
                'code'	=>  3,
            ]);


	    }
	}
?>