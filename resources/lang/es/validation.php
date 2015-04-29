<?php

return array(

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used
| by the validator class. Some of the rules contain multiple versions,
| such as the size (max, min, between) rules. These versions are used
| for different input types such as strings and files.
|
| These language lines may be easily changed to provide custom error
| messages in your application. Error messages for custom validation
| rules may also be added to this file.
|
*/

"accepted"       => "El campo :attribute debe ser aceptado.",
"active_url"     => "El campo :attribute no es una URL válida.",
"after"          => "El campo :attribute debe ser una fecha después de :date.",
"alpha"          => "El campo :attribute sólo puede contener letras.",
"alpha_dash"     => "El campo :attribute sólo puede contener letras, números y guiones.",
"alpha_num"      => "El campo :attribute sólo puede contener letras y números.",
"array"          => "El campo :attribute debe ser un arreglo.",
"before"         => "El campo :attribute debe ser una fecha antes :date.",
"between"        => array(
		"numeric" => "El campo :attribute debe estar entre :min - :max.",
		"file"    => "El campo :attribute debe estar entre :min - :max kilobytes.",
		"string"  => "El campo :attribute debe estar entre :min - :max caracteres.",
		"array"   => "El campo :attribute debe tener entre :min y :max elementos.",
),
"confirmed"      => "El campo :attribute confirmación no coincide.",
"date"           => "El campo :attribute no es una fecha válida.",
"date_format" 	 => "El campo :attribute no corresponde con el formato :format.",
"different"      => "El campo :attribute and :other debe ser diferente.",
"digits"         => "El campo :attribute debe ser de :digits dígitos.",
"digits_between" => "El campo :attribute debe terner entre :min y :max dígitos.",
"email"          => "El formato del :attribute es invalido.",
"exists"         => "El campo :attribute seleccionado es inválido.",
"image"          => "El campo :attribute debe ser una imagen.",
"in"             => "El campo :attribute seleccionado es inválido.",
"integer"        => "El campo :attribute debe ser un entero.",
"ip"             => "El campo :attribute Debe ser una dirección IP válida.",
"match"          => "El formato :attribute es inválido.",
"max"            => array(
		"numeric" => "El campo :attribute debe ser menor que :max.",
		"file"    => "El campo :attribute debe ser menor que :max kilobytes.",
		"string"  => "El campo :attribute debe ser menor que :max caracteres.",
		"array"   => "El campo :attribute debe tener al menos :min elementos.",
	),

"mimes"         => "El campo :attribute debe ser un archivo de tipo :values.",
"min"           => array(
		"numeric" => "El campo :attribute debe tener al menos :min.",
		"file"    => "El campo :attribute debe tener al menos :min kilobytes.",
		"string"  => "El campo :attribute debe tener al menos :min caracteres.",
),
"not_in"                => "El campo :attribute seleccionado es invalido.",
"numeric"               => "El campo :attribute debe ser un numero.",
"regex"                 => "El formato del campo :attribute es inválido.",
"required"              => "El campo :attribute es requerido",
"required_if"           => "El campo :attribute es requerido cuando el campo :other es :value.",
"required_with"         => "El campo :attribute es requerido cuando :values está presente.",
"required_with_all"     => "El campo :attribute es requerido cuando :values está presente.",
"required_without"      => "El campo :attribute es requerido cuando :values no está presente.",
"required_without_all"  => "El campo :attribute es requerido cuando ningún :values está presentes.",
"same"                  => "El campo :attribute y :other debe coincidir.",
"size"                  => array(
			"numeric" => "El campo :attribute debe ser :size.",
			"file"    => "El campo :attribute debe terner :size kilobytes.",
			"string"  => "El campo :attribute debe tener :size caracteres.",
			"array"   => "El campo :attribute debe contener :size elementos.",
),

"unique" => "El campo :attribute ya ha sido tomado.",
"url"    => "El formato de :attribute es inválido.",

/*
|--------------------------------------------------------------------------
| Custom Validation Language Lines
|--------------------------------------------------------------------------
|
| Here you may specify custom validation messages for attributes using the
| convention "attribute_rule" to name the lines. This helps keep your
| custom validation clean and tidy.
|
| So, say you want to use a custom validation message when validating that
| the "email" attribute is unique. Just add "email_unique" to this array
| with your custom message. The Validator will handle the rest!
|
*/

'custom' => array(
	'attribute-name' => array(
	    'rule-name'  => 'custom-message',
	),
),

/*
|--------------------------------------------------------------------------
| Validation Attributes
|--------------------------------------------------------------------------
|
| The following language lines are used to swap attribute place-holders
| with something more reader friendly such as "E-Mail Address" instead
| of "email". Your users will thank you.
|
| The Validator class will automatically search this array of lines it
| is attempting to replace the :attribute place-holder in messages.
| It's pretty slick. We think you'll like it.
|
*/

'attributes' => [
	'name'					=> 'nombre',
	'tools'					=> 'herramientas',
	'doc_type'				=> 'tipo de documento',
	'doc'					=> 'documento',
	'first_name'			=> 'nombres',
	'last_name'				=> 'apellidos',
	'specialty_id'			=> 'especialidad',
	'occupation_id'			=> 'ocupación',
	'tel'					=> 'telefono',
	'date_birth'			=> 'fecha de nacimiento',
	'sex'					=> 'género',
	'time'					=> 'tiempo',
	'doc_type_id'			=> 'tipo de documento',
	'diaryTypes'			=> 'tipo de cita',
	'name_system'			=> 'Nombre de Sistema',

	// Patient History
	'reasons'						=> 'motivos de consulta',
	'new_reasons'					=> 'nuevos motivos',
	'present_illness'				=> 'enfermedad actual',
	'system_revisions'				=> 'revisión de sistemas',
	'new_system_revisions'			=> 'nuevas revisiones',
	'procedures'					=> 'procedimientos',
	'diagnostics'					=> 'diagnosticos',
	'management_plan'				=> 'plan de manejo',
	'medical_history'				=> 'antecedentes medicos',
	'surgical_history'				=> 'antecedentes quirurgicos',
	'new_surgical_history'			=> 'nuevos antecedentes quirurgicos',
	'traumatic_history'				=> 'antecedentes traumaticos',
	'new_traumatic_history'			=> 'nuevos antecedentes traumaticos',
	'toxic_allergic_history'		=> 'antecedentes toxicos y alergicos',
	'new_toxic_allergic_history'	=> 'nuevos antecedentes toxicos y alergicos',
	'immunological_history'			=> 'antecedentes inmunologicos',
	'new_immunological_history'		=> 'nuevos antecedentes inmunologicos',
	'reproductive_history'			=> 'antecedentes ginecoobstetricos',
	'new_reproductive_history'		=> 'nuevos antecedentes ginecoobstetricos',
	'hospitalizations'				=> 'hospitalizaciones',
	'new_hospitalizations'			=> 'nuevas hospitalizaciones',
	'sexual_history'				=> 'historia sexual',

	'start_date_end_date' 	=> 'rango de fechas',
	'start_date'			=> 'fecha de inicio',
	'end_date'				=> 'fecha fin',
	'days'					=> 'días',
	'start_time'			=> 'hora de inicio',
	'end_time'				=> 'hora fin',
	
    'username' 				=> 'usuario',
    'password' 				=> 'contraseña',
    'url_photo' 			=> 'foto de perfil',
    'url_logo' 				=> 'logo',
    'url_pdf' 				=> 'PDF',
    'photo'                 => 'foto',
	'description'			=> 'Descripción',
<<<<<<< HEAD
    'cod'				    => 'Código'
=======
    // Membreship
    'cod'				=> 'Código',
    //medicament
    'presentation_id'	=> 'Presentación',
    //viamedicaments
    'via_medicament_id'	=> 'Vía del medicamento',
    //medicament
    'medicament_id'	=> 'Medicamento',
    'measure_id' => 'Medida',
    'quantity' => 'Cantidad',
    'interval' => 'Intervalo (Horas)',
    'limit' => 'Límite (Días)'
>>>>>>> e5f9003b7fea8d80de3108baf83a2c5f88fac570

]

);
