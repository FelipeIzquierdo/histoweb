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





