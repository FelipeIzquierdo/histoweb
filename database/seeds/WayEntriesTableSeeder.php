<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\WayEntry;
	/**
	* 
	*/
	class WayEntryTableSeeder extends Seeder
	{

		public function run()
	    {  	 

            WayEntry::create([
                'name'	=> 'Lapratomia',
                'description' => 'Lapratomia',
                'code'	=>  1,
            ]);

	    	 WayEntry::create([
                'name'	=> 'Craneotomia',
                'description' => 'Craneotomia',
                'code'	=>  2,
            ]);
	    	  	 
	    }
	}
?>