<?php

use \Illuminate\Database\Seeder;
use Histoweb\Entities\SystemRevision;
	/**
	* 
	*/

class SystemRevisionsTableSeeder extends Seeder {
	
	private static $systemRevisions = [	
		'estreñimiento', 'diarrea', 'disnea clase funcional ii', 'disnea clase funcional iii', 'disnea clase funcional iv', 'ortopnea', 'sibilancias', 'tos', 'nauseas', 'vomito', 'dolor epigastrico', 'artralgias', 'dolor toracico', 'palidez', 'ictericia', 'disminucion del calibre urinario', 'cefalea', '(no hay datos)', 'dolor precordial', 'negativos', 'expectoracion purulenta', 'tos productiva purulenta', 'dolor en sitio quirurgico', 'polifagia', 'disminucion de la agudeza visual', 'desorientacion', 'relajacion de esfinteres', 'bradipsiquia', 'bradilalia', 'vertigo', 'diplopia', 'alteracion de la marcha', 'astenia , adinamia', 'perdida de peso', 'sudoracion nocturna', 'fiebre', 'coluria', 'acolia', 'distension abdominal', 'paro de fecales', 'constipacion', 'encopresis', 'epigastralgia', 'somnolencia', 'deterioro neurologico', 'estridor laringeo', 'alteracion del estado de conciencia', 'convulsiones', 'disnea', 'disfonia', 'taquipnea', 'leucorrea', 'disuria', 'faringodinia', 'polaquiuria', 'deposicion con sangre', 'poliuria', 'hiporexia', 'odinofagia', 'disfagia', 'tinitus', 'fosfenos', 'fotofobia', 'temblor', 'dolor de garganta'
	];

    public function run()
    {
    	foreach (self::$systemRevisions as $name) {
	    	SystemRevision::create([
	            'name' => $name,
	        ]);
    	}	
    }
}