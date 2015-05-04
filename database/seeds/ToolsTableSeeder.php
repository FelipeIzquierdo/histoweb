<?php  
	/**
	* 
	*/
	use Illuminate\Database\Seeder;
	use Illuminate\Database\Eloquent\Model;
    use Histoweb\Entities\Tool;

	class ToolsTableSeeder extends Seeder
	{
		public function run()
	    {
	        Tool::create(array(
	            'name'          => 'Electrodos de monitoreo'
	        ));
            Tool::create(array(
                'name'          => 'Termómetro oral'
            ));
            Tool::create(array(
                'name'          => 'Termómetro digital'
            ));
            Tool::create(array(
                'name'          => 'Tensiómetro de dos servicios'
            ));
            Tool::create(array(
                'name'          => 'Fonendoscopio'
            ));
            Tool::create(array(
                'name'          => 'Pato quirúrgico'
            ));
            Tool::create(array(
                'name'          => 'Recolector de orina las 24 horas'
            ));
            Tool::create(array(
                'name'          => 'Bandeja para instrumental'
            ));
            Tool::create(array(
                'name'          => 'Camilla tipo diván'
            ));
	    }
	}
?>