<?php  
	use \Illuminate\Database\Seeder;
	use Histoweb\Entities\History;
	/**
	* 
	*/
	class HistoriesTableSeeder extends Seeder
	{
		private static $medical_history = ['cesareas', 'apendicectomia', 'colecistectomia', 'colecistectomia laparoscopica', 'herniorrafia umbilical', 'herniorrafia inguinal', 'herniorrafia epigastrica', 'laparotomia exploratoria', 'laparostomia', 'eventrorrafia', 'varicosafenectomia', 'amigdalectomia', 'legrado', 'pomeroy', 'vasectomía', 'reseccion de tumor cerebral', 'clipaje de aneurisma cerebral', 'drenaje de hematoma subdural', 'drenaje de hematoma epidural', 'osteosisntesis de humero', 'osteosintesis de cubito y radio', 'osteosisntesis de femur', 'osteosintesis de tibia', 'reduccion de luxacion del hombro', 'prostatectomia transvesical', 'prostatectomia transuretral', 'cistopexia suprapubica', 'correccion de celes', 'correccion de cistocele', 'correccion de rectocele', 'extraccion de catarata', 'endoaneurismorrafia', 'revascularizacion miocardica', 'cambio de valvula mitral', 'cambio de valvula aortica', 'reseccion intestinal con anastomosis', 'colostomia', 'reseccion de tumor del colon', 'gastrectomia', 'cierre de colostomia', 'amputacion supracondilea miembro inferior', 'amputacion miembro superior', '(ninguno)', 'histerectomia abdominal total.', 'tromectomia miembro inferior derecho', 'embolectomia arteria iliaca externa derecha', 'drenaje absceso cupula', 'colocacion cateter peritoneal para dialisis', 'retiro de cateter de dialisis peritoneal', 'fistula arterio-venosa para dialisis', 'cirugia de tobillo por trauma ', 'lobectomia pulmonar', 'nizen', 'manejo quirurgico del reflujo', '(no hay datos)', 'postoperatorio inmediato cesarea', 'faquectomia', 'craneotomia', 'correccion de fistula de liquido cefalorraquideo', 'cranealizacion de senos frontales', 'cierre de fistula de lcr', 'cranioplastia con ingerto autologo', 'derivacion ventriculo peritoneal', 'revascularizacion coronaria', 'histerectomia vaginal', 'toracostomia drenaje cerrado', 'extraccion cuerpo extraño de torax', 'reseccion fistula cuello', 'nefrosotomia bilateral', 'sutura por herida pre traqueal en cuello.', 'orquidectomia bilateral', 'ventana pericardica', 'empaquetamiento con compresas para hemostasia', 'reduccion cerrada fractura humeral', 'exploracion de la via biliar', 'colangiografia retrograda endoscopica', 'traqueostomia', 'vertebroplastia', 'mamoplastia', 'cierre de cia', 'implantacion de marcapaso.', 'sindrome intestino corto-isquemia mesenterica', 'implante de stent', 'implante de stent coronario', 'osteosintesis de codo', 'ligadura en banda de varices esofagicas.', 'puente de mamaria interna a descendente anterior', 'puente safeno a coronaria derecha', 'cpre', 'nefrostomia derecha', 'fasciotomia', 'correccion retraccion tendon ms. inferiores', 'hemicolectomia izquierda', 'reseccion segmentaria de intestino delgado', 'nefrectomia derecha', 'reduccion abierta mas osteosintesis tibioperonea d', 'lavado quirurgico rodilla', 'lavado peritoneal', 'colectomia der', 'ileostomia', 'gastrectomia subtotal', 'ligadura con bandas  de varices esofagicas', 'escleroterapia', 'sigmoidectomia', 'lobectomia derecha', 'ventriculostomia', 'hemorroidectomia', 'esplenectomia', 'minicaneotomia', 'oclusion de aneurisma cerebral', 'fenestracion del iii ventriculo', 'subdurostomia de drenaje', 'craneoplastia', 'drenaje absceso', 'tiroidectomia total'];
		private static $surgical_history = ['cesareas', 'apendicectomia', 'colecistectomia', 'colecistectomia laparoscopica', 'herniorrafia umbilical', 'herniorrafia inguinal', 'herniorrafia epigastrica', 'laparotomia exploratoria', 'laparostomia', 'eventrorrafia', 'varicosafenectomia', 'amigdalectomia', 'legrado', 'pomeroy', 'vasectomía', 'reseccion de tumor cerebral', 'clipaje de aneurisma cerebral', 'drenaje de hematoma subdural', 'drenaje de hematoma epidural', 'osteosisntesis de humero', 'osteosintesis de cubito y radio', 'osteosisntesis de femur', 'osteosintesis de tibia', 'reduccion de luxacion del hombro', 'prostatectomia transvesical', 'prostatectomia transuretral', 'cistopexia suprapubica', 'correccion de celes', 'correccion de cistocele', 'correccion de rectocele', 'extraccion de catarata', 'endoaneurismorrafia', 'revascularizacion miocardica', 'cambio de valvula mitral', 'cambio de valvula aortica', 'reseccion intestinal con anastomosis', 'colostomia', 'reseccion de tumor del colon', 'gastrectomia', 'cierre de colostomia', 'amputacion supracondilea miembro inferior', 'amputacion miembro superior', '(ninguno)', 'histerectomia abdominal total.', 'tromectomia miembro inferior derecho', 'embolectomia arteria iliaca externa derecha', 'drenaje absceso cupula', 'colocacion cateter peritoneal para dialisis', 'retiro de cateter de dialisis peritoneal', 'fistula arterio-venosa para dialisis', 'cirugia de tobillo por trauma ', 'lobectomia pulmonar', 'nizen', 'manejo quirurgico del reflujo', '(no hay datos)', 'postoperatorio inmediato cesarea', 'faquectomia', 'craneotomia', 'correccion de fistula de liquido cefalorraquideo', 'cranealizacion de senos frontales', 'cierre de fistula de lcr', 'cranioplastia con ingerto autologo', 'derivacion ventriculo peritoneal', 'revascularizacion coronaria', 'histerectomia vaginal', 'toracostomia drenaje cerrado', 'extraccion cuerpo extraño de torax', 'reseccion fistula cuello', 'nefrosotomia bilateral', 'sutura por herida pre traqueal en cuello.', 'orquidectomia bilateral', 'ventana pericardica', 'empaquetamiento con compresas para hemostasia', 'reduccion cerrada fractura humeral', 'exploracion de la via biliar', 'colangiografia retrograda endoscopica', 'traqueostomia', 'vertebroplastia', 'mamoplastia', 'cierre de cia', 'implantacion de marcapaso.', 'sindrome intestino corto-isquemia mesenterica', 'implante de stent', 'implante de stent coronario', 'osteosintesis de codo', 'ligadura en banda de varices esofagicas.', 'puente de mamaria interna a descendente anterior', 'puente safeno a coronaria derecha', 'cpre', 'nefrostomia derecha', 'fasciotomia', 'correccion retraccion tendon ms. inferiores', 'hemicolectomia izquierda', 'reseccion segmentaria de intestino delgado', 'nefrectomia derecha', 'reduccion abierta mas osteosintesis tibioperonea d', 'lavado quirurgico rodilla', 'lavado peritoneal', 'colectomia der', 'ileostomia', 'gastrectomia subtotal', 'ligadura con bandas  de varices esofagicas', 'escleroterapia', 'sigmoidectomia', 'lobectomia derecha', 'ventriculostomia', 'hemorroidectomia', 'esplenectomia', 'minicaneotomia', 'oclusion de aneurisma cerebral', 'fenestracion del iii ventriculo', 'subdurostomia de drenaje', 'craneoplastia', 'drenaje absceso', 'tiroidectomia total'];
		private static $traumatic_history = ['politraumatismo', 'trauma craneoencefalico', 'fracturas en las extremidades', 'amputaciones traumaticas', 'trauma del torax', 'trauma de abdomen', 'heridas por proyectil de arma de fuego en torax', 'heridas por proyectil de arma de fuego en abdomen', 'heridas por proyectil de arma de fuego en cabeza', 'quemaduras por calor', 'quemaduras por quimicos', 'fractura en tobillo izquierdo', 'negativo', 'trauma craneo-encefalico', 'herida en torax objeto de madera', 'fx codo', 'trauma raquimedular', 'quemaduras multiples', 'fx intertrocanterica de femur derecho', 'fractura de cadera', 'fractura de codo izquierdo', 'fractura de muñeca izquierda', 'quemadura en tronco y cara', 'quemadura en la juventud', 'herida penetrante a abdomen acp', 'fractura de femur'];
		private static $toxic_allergic_history = ['exposicion a humo de tabaco', 'exposicion a humo de leña', 'ingesta de alcohol', 'empleo de drogas sico-activas', 'exposicion a asbesto', 'exposicion a silice', 'exposicion a farmacos para quimioterapeuticos', 'exposicion a radiacion', '(no hay dato)', 'negativos', 'tabaquismmo pesado', 'ex tabaquismo', 'oxacilina', 'dipirona', 'farmacodependencia', 'intoxicacion por raticida', 'consumo de alcohol', 'metoclopramida'];
		private static $reproductive_history = ['negativos', 'nulipara ', 'multipara', 'cesareas', 'partos normales', 'menopausia', 'abortos', 'legrados', 'planificacion definitiva', 'anovulatorios orales', 'anovulatorios intramuscular', 'sin planificacion', 'histerectomia vaginal', 'histerectomia abdominal total', 'hematoma de la cupula', 'absceso cupula', 'post parto inmediato', 'negativo', 'amenorrea secundaria', 'embarazo 17 semanas por fum', 'g2p2c1a0', 'ca cuello utero', 'cancer de cervix con metastasis', 'g1p1a0', 'metrorragia', 'embarazo ectopico', 'manejo quirurgico del embarazo ectopico', 'g8p7a0', 'fup 5 años', 'g5 p2 a2', 'g3p2', 'niega actividad sexual', 'vida sexual activa', 'no planifica', 'dispareunia', 'antecedentes de cesarea', 'ciclos irregulares', 'ciclos regulares', 'pomeroy', 'puerperio mediato', 'puerperio inmediato', 'puerperio tardio', 'abortadora habitual', 'embarazoa ectopicos', 'embarazo anembrionico', 'embarazos multiples', '(no hay datos)', 'primigestante', 'g1p0a0', 'histerocele', 'no aplica', 'g9p9v5m4', 'g 13 p 6 a 7', 'g2 p2', 'trauma en pierna izq', 'g5  p5', 'g7  p5 a2', 'g 12', 'g4 p4', 'g3 p3'];
		
		public function run()
	    {
	    	//$this->createHistory(1, self::$medical_history);
	    	$this->createHistory(2, self::$surgical_history);
	    	$this->createHistory(3, self::$traumatic_history);
	    	$this->createHistory(4, self::$toxic_allergic_history);	
	    	$this->createHistory(5, self::$reproductive_history);
	    }

	    private function createHistory($history_type_id, $names)
	    {
	    	foreach ($names as $name) {
	    		History::create([
	    			'history_type_id'		=> $history_type_id,
	                'name'		=> $name
	            ]);
	    	}
	    }
	}