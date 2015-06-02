<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\MembershipType;
	/**
	* 
	*/
	class MembershipTypesTableSeeder extends Seeder
	{

		public function run()
	    {
	    	MembershipType::create([
                'name'	=> 'Particular',
            ]);

            MembershipType::create([
                'name'	=> 'Afiliado',
            ]);

	    }
	}
?>