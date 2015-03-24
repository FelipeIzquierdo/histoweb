<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Occupation;
	/**
	* 
	*/
	class OccupationsTableSeeder extends Seeder
	{
		public static $occupations = [
			'HOGAR','CESANTE', 'COMERCIANTE', 'AGRICULTOR', 'GANADERO', 'ESTUDIANTE', 'ADULTO MAYOR', 'OFICIOS VARIOS', 
			'CONDUCTOR DE VEHICULO', 'AMA DE CASA', 'POLICIA', 'MENOR DE EDAD', 'MEDICO', 'TECNICO EN REFRIGERACION', 
			'(DESCONOCIDA)', 'SECRETARIA', 'FACTURADOR', 'FONTANERO', 'MILITAR', 'VETERINARIO', 'TRABAJADORA SOCIAL', 
			'ENFERMERIA', 'BACTERIOLOGO', 'DISCAPACITADO', 'DOCENTE', 'DEPORTISTA', 'DIGITADOR', 'PROFESIONAL  ESPECIALIZADO', 
			'HABITANTE DE LA CALLE', 'EMPLEADO DE CIRCO', 'RECLUSO', 'CONSTRUCTOR', 'TIPOGRAFO', 'PANADERO'
		];

		public function run()
	    {
	    	foreach (self::$occupations as $occupation) {
		    	Occupation::create([
		            'name' => $occupation,
		        ]);
	    	}	        
	    }


	}
?>