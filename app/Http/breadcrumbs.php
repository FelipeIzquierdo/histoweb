<?php

// Inicio
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Inicio', url('/'));
});

// Inicio > Admin
Breadcrumbs::register('admin', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Admin', route('admin'));
});

// Inicio > Admin > Sistema
Breadcrumbs::register('system', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Sistema', route('admin.system'));
});

// Inicio > Admin > Sistema > Herramientas
Breadcrumbs::register('tools', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Herramientas', route('admin.system.tools.index'));
});

// Inicio > Admin > Sistema > Herramientas > Create or Edit
Breadcrumbs::register('tools.create', function($breadcrumbs, $tool)
{
    $breadcrumbs->parent('tools');
    if($tool->exists)
    {
    	$breadcrumbs->push($tool->name, route('admin.system.tools.edit', $tool->id));
    }
    else
    {
    	$breadcrumbs->push('Nueva', route('admin.system.tools.create'));
    }
});

// Inicio > Admin > Sistema > Especialidades
Breadcrumbs::register('specialties', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Especialidades', route('admin.system.specialties.index'));
});

// Inicio > Admin > Sistema > Especialidades > Create or Edit
Breadcrumbs::register('specialties.create', function($breadcrumbs, $specialty)
{
    $breadcrumbs->parent('specialties');
    if($specialty->exists)
    {
    	$breadcrumbs->push($specialty->name, route('admin.system.specialties.edit', $specialty->id));
    }
    else
    {
    	$breadcrumbs->push('Nueva', route('admin.system.specialties.create'));
    }
});

// Inicio > Admin > Sistema > Tipos de citas
Breadcrumbs::register('diary_types', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Tipos de citas', route('admin.system.diary-types.index'));
});

// Inicio > Admin > Sistema > Tipos de citas > Create or Edit
Breadcrumbs::register('diary_types.create', function($breadcrumbs, $diary_types)
{
    $breadcrumbs->parent('diary_types');
    if($diary_types->exists)
    {
        $breadcrumbs->push($diary_types->name, route('admin.system.diary-types.edit', $diary_types->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.diary-types.create'));
    }
});

// Inicio > Admin > Sistema > Afiliaciones
Breadcrumbs::register('membership', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Afiliaciones', route('admin.system.memberships.index'));
    
});

// Inicio > Admin > Sistema > Afiliaciones > Create or Edit
Breadcrumbs::register('membership.create', function($breadcrumbs, $membership)
{
    $breadcrumbs->parent('membership');
    if($membership->exists)
    {
        $breadcrumbs->push($membership->name, route('admin.system.memberships.edit', $membership->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.memberships.create'));
    }
});

// Inicio > Admin > Sistema > Tipos de procedimiento
Breadcrumbs::register('procedure_type', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Tipos de procedimiento', route('admin.system.procedure-types.index'));
    
});

// Inicio > Admin > Sistema > Tipos de procedimiento > Create or Edit
Breadcrumbs::register('procedure_type.create', function($breadcrumbs, $procedure_type)
{
    $breadcrumbs->parent('procedure_type');
    if($procedure_type->exists)
    {
        $breadcrumbs->push($procedure_type->name, route('admin.system.procedure-types.edit', $procedure_type->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.procedure-types.create'));
    }
});

// Inicio > Admin > Sistema > Procedimientos
Breadcrumbs::register('procedure', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Procedimientos', route('admin.system.procedures.index'));
    
});

// Inicio > Admin > Sistema > Procedimientos > Create or Edit
Breadcrumbs::register('procedure.create', function($breadcrumbs, $procedure)
{
    $breadcrumbs->parent('procedure');
    if($procedure->exists)
    {
        $breadcrumbs->push($procedure->name, route('admin.system.procedures.edit', $procedure->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.procedures.create'));
    }
});

// Inicio > Admin > Sistema > Enfermedades
Breadcrumbs::register('disease', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Enfermedades', route('admin.system.diseases.index'));
    
});

// Inicio > Admin > Sistema > Enfermedades > Create or Edit
Breadcrumbs::register('disease.create', function($breadcrumbs, $disease)
{
    $breadcrumbs->parent('disease');
    if($disease->exists)
    {
        $breadcrumbs->push($disease->name, route('admin.system.diseases.edit', $disease->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.diseases.create'));
    }
});

// Inicio > Admin > Sistema > Revisión de sistemas
Breadcrumbs::register('system_revision', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Revisión de sistemas', route('admin.system.system-revisions.index'));
    
});

// Inicio > Admin > Sistema > Revisión de sistemas > Create or Edit
Breadcrumbs::register('system_revision.create', function($breadcrumbs, $system_revision)
{
    $breadcrumbs->parent('system_revision');
    if($system_revision->exists)
    {
        $breadcrumbs->push($system_revision->name, route('admin.system.system-revisions.edit', $system_revision->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.system-revisions.create'));
    }
});

// Inicio > Admin > Sistema > Motivos de consulta
Breadcrumbs::register('reason', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Motivos de consulta', route('admin.system.reasons.index'));
    
});

// Inicio > Admin > Sistema > Motivos de consulta > Create or Edit
Breadcrumbs::register('reason.create', function($breadcrumbs, $reason)
{
    $breadcrumbs->parent('reason');
    if($reason->exists)
    {
        $breadcrumbs->push($reason->name, route('admin.system.reasons.edit', $reason->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.reasons.create'));
    }
});

// Inicio > Admin > Sistema > Tipos de antecedentes
Breadcrumbs::register('history_type', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Tipos de antecedentes', route('admin.system.history-types.index'));
    
});

// Inicio > Admin > Sistema > Tipos de antecedentes > Create or Edit
Breadcrumbs::register('history_type.create', function($breadcrumbs, $history_type)
{
    $breadcrumbs->parent('history_type');
    if($history_type->exists)
    {
        $breadcrumbs->push($history_type->name, route('admin.system.history-types.edit', $history_type->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.history-types.create'));
    }
});

// Inicio > Admin > Sistema > Antecendentes
Breadcrumbs::register('history', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Antecendentes', route('admin.system.histories.index'));
    
});

// Inicio > Admin > Sistema > Antecendentes > Create or Edit
Breadcrumbs::register('history.create', function($breadcrumbs, $history)
{
    $breadcrumbs->parent('history');
    if($history->exists)
    {
        $breadcrumbs->push($history->name, route('admin.system.histories.edit', $history->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.histories.create'));
    }
});

// Inicio > Admin > Sistema > EPS
Breadcrumbs::register('eps', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('EPS', route('admin.system.eps.index'));
    
});

// Inicio > Admin > Sistema > EPS > Create or Edit
Breadcrumbs::register('eps.create', function($breadcrumbs, $eps)
{
    $breadcrumbs->parent('eps');
    if($eps->exists)
    {
        $breadcrumbs->push($eps->name, route('admin.system.eps.edit', $eps->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.eps.create'));
    }
});

// Inicio > Admin > Sistema > Profesiones
Breadcrumbs::register('profession', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Profesiones', route('admin.system.professions.index'));
    
});

// Inicio > Admin > Sistema > Profesiones > Create or Edit
Breadcrumbs::register('profession.create', function($breadcrumbs, $profession)
{
    $breadcrumbs->parent('profession');
    if($profession->exists)
    {
        $breadcrumbs->push($profession->name, route('admin.system.professions.edit', $profession->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.professions.create'));
    }
});

// Inicio > Admin > Sistema > Tipos de Anestesia
Breadcrumbs::register('anesthesiaType', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Tipos de Anestesia', route('admin.system.anesthesiaTypes.index'));
    
});

// Inicio > Admin > Sistema > Tipos de Anestesia > Create or Edit
Breadcrumbs::register('anesthesiaType.create', function($breadcrumbs, $anesthesiaType)
{
    $breadcrumbs->parent('anesthesiaType');
    if($anesthesiaType->exists)
    {
        $breadcrumbs->push($anesthesiaType->name, route('admin.system.anesthesiaTypes.edit', $anesthesiaType->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.anesthesiaTypes.create'));
    }
});

// Inicio > Admin > Sistema > Medicamentos
Breadcrumbs::register('medicament', function($breadcrumbs)
{
    $breadcrumbs->parent('system');
    $breadcrumbs->push('Medicamentos', route('admin.system.medicament'));
});

// Inicio > Admin > Sistema > Medicamentos > Presentaciones
Breadcrumbs::register('presentation', function($breadcrumbs)
{
    $breadcrumbs->parent('medicament');
    $breadcrumbs->push('Presentaciones', route('admin.system.medicament.presentations.index'));
    
});

// Inicio > Admin > Sistema > Medicamentos > Presentaciones > Create or Edit
Breadcrumbs::register('presentation.create', function($breadcrumbs, $presentation)
{
    $breadcrumbs->parent('presentation');
    if($presentation->exists)
    {
        $breadcrumbs->push($presentation->name, route('admin.system.medicament.presentations.edit', $presentation->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.medicament.presentations.create'));
    }
});

// Inicio > Admin > Sistema > Medicamentos > Unidades
Breadcrumbs::register('unit', function($breadcrumbs)
{
    $breadcrumbs->parent('medicament');
    $breadcrumbs->push('Unidades', route('admin.system.medicament.units.index'));
    
});

// Inicio > Admin > Sistema > Medicamentos > Unidades > Create or Edit
Breadcrumbs::register('unit.create', function($breadcrumbs, $unit)
{
    $breadcrumbs->parent('unit');
    if($unit->exists)
    {
        $breadcrumbs->push($unit->name, route('admin.system.medicament.units.edit', $unit->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.medicament.units.create'));
    }
});

// Inicio > Admin > Sistema > Medicamentos > Diluyentes
Breadcrumbs::register('diluent', function($breadcrumbs)
{
    $breadcrumbs->parent('medicament');
    $breadcrumbs->push('Diluyentes', route('admin.system.medicament.diluents.index'));
    
});

// Inicio > Admin > Sistema > Medicamentos > Diluyentes > Create or Edit
Breadcrumbs::register('diluent.create', function($breadcrumbs, $diluent)
{
    $breadcrumbs->parent('diluent');
    if($diluent->exists)
    {
        $breadcrumbs->push($diluent->name, route('admin.system.medicament.diluents.edit', $diluent->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.medicament.diluents.create'));
    }
});

// Inicio > Admin > Sistema > Medicamentos > Laboratorios
Breadcrumbs::register('lab', function($breadcrumbs)
{
    $breadcrumbs->parent('medicament');
    $breadcrumbs->push('Laboratorios', route('admin.system.medicament.labs.index'));
    
});

// Inicio > Admin > Sistema > Medicamentos > Laboratorios > Create or Edit
Breadcrumbs::register('lab.create', function($breadcrumbs, $lab)
{
    $breadcrumbs->parent('lab');
    if($lab->exists)
    {
        $breadcrumbs->push($lab->name, route('admin.system.medicament.labs.edit', $lab->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.medicament.labs.create'));
    }
});

// Inicio > Admin > Sistema > Medicamentos > Vía de administración
Breadcrumbs::register('administration_route', function($breadcrumbs)
{
    $breadcrumbs->parent('medicament');
    $breadcrumbs->push('Vía de administración', route('admin.system.medicament.administration-routes.index'));
    
});

// Inicio > Admin > Sistema > Medicamentos > Vía de administración > Create or Edit
Breadcrumbs::register('administration_route.create', function($breadcrumbs, $administration_route)
{
    $breadcrumbs->parent('administration_route');
    if($administration_route->exists)
    {
        $breadcrumbs->push($administration_route->name, route('admin.system.medicament.administration-routes.edit', $administration_route->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.medicament.administration-routes.create'));
    }
});

// Inicio > Admin > Sistema > Medicamentos > Medicamentos Genéricos 
Breadcrumbs::register('generic_medication', function($breadcrumbs)
{
    $breadcrumbs->parent('medicament');
    $breadcrumbs->push('Medicamentos Genéricos', route('admin.system.medicament.generic-medications.index'));
    
});

// Inicio > Admin > Sistema > Medicamentos > Medicamentos Genéricos  > Create or Edit
Breadcrumbs::register('generic_medication.create', function($breadcrumbs, $generic_medication)
{
    $breadcrumbs->parent('generic_medication');
    if($generic_medication->exists)
    {
        $breadcrumbs->push($generic_medication->name, route('admin.system.medicament.generic-medications.edit', $generic_medication->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.medicament.generic-medications.create'));
    }
});

// Inicio > Admin > Sistema > Medicamentos > Medicamentos Comerciales 
Breadcrumbs::register('commercial_medication', function($breadcrumbs)
{
    $breadcrumbs->parent('medicament');
    $breadcrumbs->push('Medicamentos Comerciales', route('admin.system.medicament.commercial-medications.index'));
    
});

// Inicio > Admin > Sistema > Medicamentos > Medicamentos Comerciales  > Create or Edit
Breadcrumbs::register('commercial_medication.create', function($breadcrumbs, $commercial_medication)
{
    $breadcrumbs->parent('commercial_medication');
    if($commercial_medication->exists)
    {
        $breadcrumbs->push($commercial_medication->name, route('admin.system.medicament.commercial-medications.edit', $commercial_medication->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.medicament.commercial_medications.create'));
    }
});

// Inicio > Admin > Sistema > Medicamentos > Concentraciones 
Breadcrumbs::register('concentration', function($breadcrumbs)
{
    $breadcrumbs->parent('medicament');
    $breadcrumbs->push('Concentraciones', route('admin.system.medicament.concentrations.index'));
    
});

// Inicio > Admin > Sistema > Medicamentos > Concentraciones  > Create or Edit
Breadcrumbs::register('concentration.create', function($breadcrumbs, $concentration)
{
    $breadcrumbs->parent('concentration');
    if($concentration->exists)
    {
        $breadcrumbs->push($concentration->name, route('admin.system.medicament.concentrations.edit', $concentration->id));
    }
    else
    {
        $breadcrumbs->push('Nueva', route('admin.system.medicament.concentrations.create'));
    }
});

// Inicio > Admin > Institución
Breadcrumbs::register('company', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Institución', route('admin.company'));
});

// Inicio > Admin > Institución > Consultorios
Breadcrumbs::register('surgeries', function($breadcrumbs)
{
    $breadcrumbs->parent('company');
    $breadcrumbs->push('Consultorios', route('admin.company.surgeries.index'));
});

// Inicio > Admin > Institución > Consultorios > Create or Edit
Breadcrumbs::register('surgeries.create', function($breadcrumbs, $surgery)
{
    $breadcrumbs->parent('surgeries');
    if($surgery->exists)
    {
    	$breadcrumbs->push($surgery->name, route('admin.company.surgeries.edit', $surgery->id));
    }
    else
    {
    	$breadcrumbs->push('Nuevo', route('admin.company.surgeries.create'));
    }
});

// Inicio > Admin > Institución > Consultorios > Edit > Disponibilidad
Breadcrumbs::register('surgeries.availabilities', function($breadcrumbs, $surgery)
{
    $breadcrumbs->parent('surgeries.create', $surgery);
    $breadcrumbs->push('Disponibilidad', route('admin.company.surgeries.availabilities.index', $surgery->id));
});

// Inicio > Admin > Institución > Consultorios > Edit > Citas
Breadcrumbs::register('surgeries.diaries', function($breadcrumbs, $surgery)
{
    $breadcrumbs->parent('surgeries.create', $surgery);
    $breadcrumbs->push('Citas', route('admin.company.surgeries.diaries.index', $surgery->id));
});

// Inicio > Admin > Institución > Doctores
Breadcrumbs::register('doctors', function($breadcrumbs)
{
    $breadcrumbs->parent('company');
    $breadcrumbs->push('Doctores', route('admin.company.doctors.index'));
});

// Inicio > Admin > Institución > Doctores > Create or Edit
Breadcrumbs::register('doctors.create', function($breadcrumbs, $doctor)
{
    $breadcrumbs->parent('doctors');
    if($doctor->exists)
    {
    	$breadcrumbs->push($doctor->name, route('admin.company.doctors.edit', $doctor->id));
    }
    else
    {
    	$breadcrumbs->push('Nuevo', route('admin.company.doctors.create'));
    }
});

// Inicio > Admin > Institución > Doctores > Edit > Disponibilidad
Breadcrumbs::register('doctors.availabilities', function($breadcrumbs, $doctor)
{
    $breadcrumbs->parent('doctors.create', $doctor);
    $breadcrumbs->push('Disponibilidad', route('admin.company.doctors.availabilities.index', $doctor->id));
});

// Inicio > Admin > Institución > Doctores > Edit > Disponibilidad > Nueva
Breadcrumbs::register('doctors.availabilities.create', function($breadcrumbs, $doctor)
{
    $breadcrumbs->parent('doctors.availabilities', $doctor);
    $breadcrumbs->push('Nueva', route('admin.company.doctors.availabilities.create'));
});

// Inicio > Admin > Institución > Doctores > Edit > Citas
Breadcrumbs::register('doctors.diaries', function($breadcrumbs, $doctor)
{
    $breadcrumbs->parent('doctors.create', $doctor);
    $breadcrumbs->push('Citas', route('admin.company.doctors.diaries.index', $doctor->id));
});

// Inicio > Admin > Institución > Pacientes
Breadcrumbs::register('patients', function($breadcrumbs)
{
    $breadcrumbs->parent('company');
    $breadcrumbs->push('Pacientes', route('admin.company.patients.index'));
});

// Inicio > Admin > Institución > Pacientes > Create or Edit
Breadcrumbs::register('patients.create', function($breadcrumbs, $patient)
{
    $breadcrumbs->parent('patients');
    if($patient->exists)
    {
    	$breadcrumbs->push($patient->name, route('admin.company.patients.edit', $patient->id));
    }
    else
    {
    	$breadcrumbs->push('Nuevo', route('admin.company.patients.create'));
    }
});

// Inicio > Admin > Recepción
Breadcrumbs::register('reception', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Recepción', route('reception'));
});

// Inicio > Admin > Asistencia
Breadcrumbs::register('assistance', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Asistencia', route('assistance'));
});

// Inicio > Admin > Asistencia > Opciones
Breadcrumbs::register('option', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('assistance');
    $breadcrumbs->push('Opciones', route('assistance.entries.options',$id));
});



