<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Staff;
	/**
	* 
	*/
	class StaffTableSeeder extends Seeder
	{

		public function run()
	    {
	    	 Staff::create([
                'name'	=> 'Julio Naranjas',
                'description' => 'intrumentador',
                'code'	=>  1,
            ]);

            Staff::create([
                'name'	=> 'andres Perez',
                'description' => 'aseo',
                'code'	=>  2,
            ]);

            Staff::create([
                'name'  => 'Ana Giraldo',
                'description' => 'secretaria',
                'code'  =>  3,
            ]);

            Staff::create([
                'name'  => 'Andrés Pinzón',
                'description' => 'jefe sistemas',
                'code'  =>  4,
            ]);

            \DB::table('profession_staff')->insertGetId(array(
                'staff_id'              => 1,
                'profession_id'      => 3,
            ));

            \DB::table('profession_staff')->insertGetId(array(
                'staff_id'              => 1,
                'profession_id'      => 2,
            ));

            \DB::table('profession_staff')->insertGetId(array(
                'staff_id'              => 2,
                'profession_id'      => 1,
            ));



	    }
	}
?>