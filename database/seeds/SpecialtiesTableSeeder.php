<?php  
	/**
	* 
	*/
	use Illuminate\Database\Seeder;
	use Illuminate\Database\Eloquent\Model;

	class SpecialtiesTableSeeder extends Seeder
	{
		public function run()
	    {
	        DB::table('specialties')->insert(array(
	            'name'  => 'Alergología',
	        ));
            DB::table('specialties')->insert(array(
                'name'  => 'Anestesiología y reanimación',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Cardiología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Gastroenterología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Endocrinología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Geriatría',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Hematología y hemoterapia',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Hidrología médica',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Infectología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Medicina aeroespacial',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Medicina del deporte',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Medicina del trabajo',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Medicina de urgencias',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Medicina familiar y comunitaria',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Medicina intensiva',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Medicina interna',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Medicina legal y forense',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Medicina preventiva y salud pública',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Neumología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Neurología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Nutriología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Odontología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Oftalmología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Oncología médica',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Oncología radioterápica',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Otorrinolaringología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Pediatría',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Proctología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Psiquiatría',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Rehabilitación',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Reumatología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Traumatología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Toxicología',
            ));
            DB::table('specialties')->insert(array(
                'name'  => 'Urología',
            ));


	    }
	}

?>