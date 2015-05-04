<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\DiaryType;
	/**
	* 
	*/
	class DiaryTypesTableSeeder extends Seeder
	{

		public function run()
	    {
	    	\DB::table('diary_types')->insert([
                'name'	=> 'Rutina',
                'time'	=> 30
            ]);

	    }
	}
?>