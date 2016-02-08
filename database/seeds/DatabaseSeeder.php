<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('DocTypesTableSeeder');
		$this->call('DiaryTypesTableSeeder');
		$this->call('HistoryTypesTableSeeder');

		$this->call('EpsTableSeeder');
		$this->call('MembershipTypesTableSeeder');

		$this->call('HistoriesTableSeeder');
		$this->call('OccupationsTableSeeder');
		$this->call('ReasonsTableSeeder');
		$this->call('SystemRevisionsTableSeeder');
		$this->call('ProcedureTypesTableSeeder');
		$this->call('ProceduresTableSeeder');
		
		$this->call('RolesTableSeeder');
		$this->call('UserTableSeeder');
        $this->call('SpecialtiesTableSeeder');
        $this->call('DoctorsTableSeeder');
        $this->call('ToolsTableSeeder');
        $this->call('SurgeriesTableSeeder');

        $this->call('PatientsTableSeeder');
        $this->call('AnesthesiaTypesTableSeeder');
        $this->call('StateWaysTableSeeder');
        $this->call('WayEntryTableSeeder');
        $this->call('ProfessionsTableSeeder');

        $this->call('UnitsTableSeeder');
        $this->call('DiluentsTableSeeder');
        $this->call('AdministrationRoutesTableSeeder');
        $this->call('PresentationsTableSeeder');
        $this->call('GenericMedicationsTableSeeder');
        $this->call('ConcentrationsTableSeeder');
        $this->call('LabsTableSeeder');
        //$this->call('CommercialMedicationsTableSeeder');
        $this->call('StaffTableSeeder');
        $this->call('DiseasesTableSeeder');
	}

}
