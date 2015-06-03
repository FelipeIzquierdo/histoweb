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
	    	DiaryType::create([
	    		'name'	=> 'Rutina',
	    		'time'	=> 30
	    	]);

	    	DiaryType::create([
	    		'name'	=> 'Nueva consulta',
	    		'time'	=> 60
	    	]);

	    }
	}
?>