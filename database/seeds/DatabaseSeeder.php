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
		$this->call('HistoriesTableSeeder');
		$this->call('OccupationsTableSeeder');
		$this->call('ReasonsTableSeeder');
		$this->call('SystemRevisionsTableSeeder');
		$this->call('ProceduresTableSeeder');
		
		$this->call('UserTableSeeder');
        $this->call('SpecialtiesTableSeeder');
        $this->call('DoctorsTableSeeder');
        $this->call('ToolsTableSeeder');
        $this->call('SurgeriesTableSeeder');

        $this->call('PatientsTableSeeder');
	}

}
