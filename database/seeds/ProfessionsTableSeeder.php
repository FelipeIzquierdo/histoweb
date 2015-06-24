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
                'id'	=>  1,
            ]);

            Profession::create([
                'name'	=> 'Ingeneria  Mecanica',
                'description' => 'Ingeneria  Mecanica',
                'id'	=>  2,
            ]);

            Profession::create([
                'name'	=> 'Instrumentador',
                'description' => 'Instrumentador',
                'id'	=>  3,
            ]);


	    }
	}
?>