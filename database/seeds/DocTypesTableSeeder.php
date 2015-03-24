<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\DocType;
	/**
	* 
	*/
	class DocTypesTableSeeder extends Seeder
	{
		public static $doc_types = ['CC', 'TI', 'CE', 'PAS', 'RC', 'NID'];

		public function run()
	    {
	    	foreach (self::$doc_types as $doc_type) {
		    	DocType::create([
		            'name' => $doc_type,
		        ]);
	    	}	        
	    }


	}
?>