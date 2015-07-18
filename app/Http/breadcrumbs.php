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





