<?php  
	/**
	* 
	*/
	use Illuminate\Database\Seeder;
	use Illuminate\Database\Eloquent\Model;
    use Histoweb\Entities\Specialty;

	class SpecialtiesTableSeeder extends Seeder
	{
		public function run()
	    {
	        Specialty::create(array(
	            'name'  => 'Alergología',
                'code'  => '1',
	        ));
            Specialty::create(array(
                'name'  => 'Anestesiología y reanimación',
                'code'  => '2',
            ));
            Specialty::create(array(
                'name'  => 'Cardiología',
                'code'  => '3',
            ));
            Specialty::create(array(
                'name'  => 'Gastroenterología',
                'code'  => '4',
            ));
            Specialty::create(array(
                'name'  => 'Endocrinología',
                'code'  => '5',
            ));
            Specialty::create(array(
                'name'  => 'Geriatría',
                'code'  => '6',
            ));
            Specialty::create(array(
                'name'  => 'Hematología y hemoterapia',
                'code'  => '7',
            ));
            Specialty::create(array(
                'name'  => 'Hidrología médica',
                'code'  => '8',
            ));
            Specialty::create(array(
                'name'  => 'Infectología',
                'code'  => '9',
            ));
            Specialty::create(array(
                'name'  => 'Medicina aeroespacial',
                'code'  => '10',
            ));
            Specialty::create(array(
                'name'  => 'Medicina del deporte',
                'code'  => '11',
            ));
            Specialty::create(array(
                'name'  => 'Medicina del trabajo',
                'code'  => '12',
            ));
            Specialty::create(array(
                'name'  => 'Medicina de urgencias',
                'code'  => '13',
            ));
            Specialty::create(array(
                'name'  => 'Medicina familiar y comunitaria',
                'code'  => '14',
            ));
            Specialty::create(array(
                'name'  => 'Medicina intensiva',
                'code'  => '15',
            ));
            Specialty::create(array(
                'name'  => 'Medicina interna',
                'code'  => '16',
            ));
            Specialty::create(array(
                'name'  => 'Medicina legal y forense',
                'code'  => '17',
            ));
            Specialty::create(array(
                'name'  => 'Medicina preventiva y salud pública',
                'code'  => '18',
            ));
            Specialty::create(array(
                'name'  => 'Neumología',
                'code'  => '19',
            ));
            Specialty::create(array(
                'name'  => 'Neurología',
                'code'  => '20',
            ));
            Specialty::create(array(
                'name'  => 'Nutriología',
                'code'  => '21',
            ));
            Specialty::create(array(
                'name'  => 'Odontología',
                'code'  => '22',
            ));
            Specialty::create(array(
                'name'  => 'Oftalmología',
                'code'  => '23',
            ));
            Specialty::create(array(
                'name'  => 'Oncología médica',
                'code'  => '24',
            ));            
            Specialty::create(array(
                'name'  => 'Otorrinolaringología',
                'code'  => '25',
            ));
            Specialty::create(array(
                'name'  => 'Pediatría',
                'code'  => '26',
            ));
            Specialty::create(array(
                'name'  => 'Proctología',
                'code'  => '27',
            ));
            Specialty::create(array(
                'name'  => 'Psiquiatría',
                'code'  => '28',
            ));
            Specialty::create(array(
                'name'  => 'Rehabilitación',
                'code'  => '29',
            ));
            Specialty::create(array(
                'name'  => 'Reumatología',
                'code'  => '30',
            ));
            Specialty::create(array(
                'name'  => 'Traumatología',
                'code'  => '31',
            ));
            Specialty::create(array(
                'name'  => 'Toxicología',
                'code'  => '32',
            ));
            Specialty::create(array(
                'name'  => 'Urología',
                'code'  => '33',
            ));
            Specialty::create(array(
                'name'  => 'Oncología radioterápica',
                'code'  => '34',
            ));


	    }
	}

?>