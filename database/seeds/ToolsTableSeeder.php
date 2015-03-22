<?php  
	/**
	* 
	*/
	use Illuminate\Database\Seeder;
	use Illuminate\Database\Eloquent\Model;

	class ToolsTableSeeder extends Seeder
	{
		public function run()
	    {
	        DB::table('tools')->insert(array(
	            'name'          => 'Electrodos de monitoreo'
	        ));
            DB::table('tools')->insert(array(
                'name'          => 'Termómetro oral'
            ));
            DB::table('tools')->insert(array(
                'name'          => 'Termómetro digital'
            ));
            DB::table('tools')->insert(array(
                'name'          => 'Tensiómetro de dos servicios'
            ));
            DB::table('tools')->insert(array(
                'name'          => 'Fonendoscopio'
            ));
            DB::table('tools')->insert(array(
                'name'          => 'Pato quirúrgico'
            ));
            DB::table('tools')->insert(array(
                'name'          => 'Recolector de orina las 24 horas'
            ));
            DB::table('tools')->insert(array(
                'name'          => 'Bandeja para instrumental'
            ));
            DB::table('tools')->insert(array(
                'name'          => 'Camilla tipo diván'
            ));
	    }
	}
?>