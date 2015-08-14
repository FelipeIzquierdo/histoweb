<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\Disease;
	/**
	* 
	*/
	class DiseasesTableSeeder extends Seeder
	{

		private static $diaseases = [
			[
				'cod' => 'A000',
				'name' => 'COLERA DEBIDO A VIBRIO CHOLERAE O1, BIOTIPO CHOLERAE' 
			],
			[
				'cod' => 'A001',
				'name' => 'COLERA DEBIDO A VIBRIO CHOLERAE O1, BIOTIPO EL TOR' 
			],
			[
				'cod' => 'A009',
				'name' => 'COLERA NO ESPECIFICADO' 
			],
			[
				'cod' => 'A010',
				'name' => 'FIEBRE TIFOIDEA' 
			],
			[
				'cod' => 'A011',
				'name' => 'FIEBRE PARATIFOIDEA   A' 
			],
			[
				'cod' => 'A012',
				'name' => 'FIEBRE PARATIFOIDEA   B' 
			],
			[
				'cod' => 'A013',
				'name' => 'FIEBRE PARATIFOIDEA   C' 
			],
			[
				'cod' => 'A014',
				'name' => 'FIEBRE PARATIFOIDEA, NO ESPECIFICADA' 
			],
			[
				'cod' => 'A020',
				'name' => 'ENTERITIS DEBIDA A SALMONELLA' 
			],
			[
				'cod' => 'A021',
				'name' => 'SEPTICEMIA DEBIDA A SALMONELLA' 
			],
			[
				'cod' => 'A022',
				'name' => 'INFECCIONES LOCALIZADAS DEBIDA A SALMONELLA' 
			],
			[
				'cod' => 'A028',
				'name' => 'OTRAS INFECCIONES ESPECIFICADAS COMO DEBIDAS A SALMONELLA' 
			],
			[
				'cod' => 'A029',
				'name' => 'INFECCIÓN DEBIDA A SALMONELLA NO ESPECIFICADA' 
			],
			[
				'cod' => 'A030',
				'name' => 'SHIGELOSIS DEBIDA A SHIGELLA DYSENTERIAE' 
			],
			[
				'cod' => 'A031',
				'name' => 'SHIGELOSIS DEBIDA A SHIGELLA  FLEXNERI' 
			],
			[
				'cod' => 'A032',
				'name' => 'SHIGELOSIS DEBIDA A SHIGELLA BOYDII' 
			],
			[
				'cod' => 'A033',
				'name' => 'SHIGELOSIS DEBIDA A SHIGELLA SONNEI' 
			],
			[
				'cod' => 'A038',
				'name' => 'OTRAS SHIGELOSIS' 
			],
			[
				'cod' => 'A039',
				'name' => 'SHIGELOSIS DE TIPO NO ESPECIFICADO' 
			],
			[
				'cod' => 'A040',
				'name' => 'INFECCION DEBIDA A ESCHERICHIA COLI ENTEROPATOGENA' 
			],
			[
				'cod' => 'A041',
				'name' => 'INFECCION DEBIDA A ESCHERICHIA COLI ENTEROTOXIGENA' 
			],
			[
				'cod' => 'A042',
				'name' => 'INFECCION DEBIDA A ESCHERICHIA COLI ENTEROINVASIVA' 
			],
			[
				'cod' => 'A043',
				'name' => 'INFECCION DEBIDA A ESCHERICHIA COLI ENTEROHEMORRAGICA' 
			],
			[
				'cod' => 'A044',
				'name' => 'OTRAS INFECCIONES INTESTINALES DEBIDAS A ESCHERICHIA COLI' 
			],
			[
				'cod' => 'A045',
				'name' => 'ENTERITIS DEBIDA A CAMPYLOBACTER' 
			],
			[
				'cod' => 'A046',
				'name' => 'ENTERITIS DEBIDA A YERSINIA ENTEROCOLITICA' 
			],
			[
				'cod' => 'A047',
				'name' => 'ENTEROCOLITIS DEBIDA A CLOSTRIDIUM DIFFICILE' 
			],
			[
				'cod' => 'A048',
				'name' => 'OTRAS INFECCIONES INTESTINALES BACTERIANAS ESPECIFICADAS' 
			],
			[
				'cod' => 'A049',
				'name' => 'INFECCION INTESTINAL BACTERIANA, NO ESPECIFICADA' 
			],
			[
				'cod' => 'A050',
				'name' => 'INTOXICACION ALIMENTARIA ESTAFILOCOCICA' 
			],
			[
				'cod' => 'A051',
				'name' => 'BOTULISMO' 
			],
			[
				'cod' => 'A052',
				'name' => 'INTOXICACION ALIMENTARIA  DEBIDA A CLOSTRIDIUM PERFRINGENS [CLOSTRIDIUM WELCHII]' 
			]		
		];
		
		public function run()
	    {
	    	foreach (self::$diaseases as $type) 
	    	{
	    		Disease::create([
	    				'cod'			=> $type[	'cod'],
	                	'name'			=> $type[	'name'],
	            ]);
	    	}
	    }
	}
?>