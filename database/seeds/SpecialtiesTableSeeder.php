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
                'id'  => '1',
	        ));
            Specialty::create(array(
                'name'  => 'Anestesiología',
                'id'  => '2',
            ));
            Specialty::create(array(
                'name'  => 'Cardiología',
                'id'  => '3',
            ));
            Specialty::create(array(
                'name'  => 'Gastroenterología',
                'id'  => '4',
            ));
            Specialty::create(array(
                'name'  => 'Endocrinología',
                'id'  => '5',
            ));
            Specialty::create(array(
                'name'  => 'Geriatría',
                'id'  => '6',
            ));
            Specialty::create(array(
                'name'  => 'Hematología y hemoterapia',
                'id'  => '7',
            ));
            Specialty::create(array(
                'name'  => 'Hidrología médica',
                'id'  => '8',
            ));
            Specialty::create(array(
                'name'  => 'Infectología',
                'id'  => '9',
            ));
            Specialty::create(array(
                'name'  => 'Medicina aeroespacial',
                'id'  => '10',
            ));
            Specialty::create(array(
                'name'  => 'Medicina del deporte',
                'id'  => '11',
            ));
            Specialty::create(array(
                'name'  => 'Medicina del trabajo',
                'id'  => '12',
            ));
            Specialty::create(array(
                'name'  => 'Medicina de urgencias',
                'id'  => '13',
            ));
            Specialty::create(array(
                'name'  => 'Medicina familiar y comunitaria',
                'id'  => '14',
            ));
            Specialty::create(array(
                'name'  => 'Medicina intensiva',
                'id'  => '15',
            ));
            Specialty::create(array(
                'name'  => 'Medicina interna',
                'id'  => '16',
            ));
            Specialty::create(array(
                'name'  => 'Medicina legal y forense',
                'id'  => '17',
            ));
            Specialty::create(array(
                'name'  => 'Medicina preventiva y salud pública',
                'id'  => '18',
            ));
            Specialty::create(array(
                'name'  => 'Neumología',
                'id'  => '19',
            ));
            Specialty::create(array(
                'name'  => 'Neurología',
                'id'  => '20',
            ));
            Specialty::create(array(
                'name'  => 'Nutriología',
                'id'  => '21',
            ));
            Specialty::create(array(
                'name'  => 'Odontología',
                'id'  => '22',
            ));
            Specialty::create(array(
                'name'  => 'Oftalmología',
                'id'  => '23',
            ));
            Specialty::create(array(
                'name'  => 'Oncología médica',
                'id'  => '24',
            ));            
            Specialty::create(array(
                'name'  => 'Otorrinolaringología',
                'id'  => '25',
            ));
            Specialty::create(array(
                'name'  => 'Pediatría',
                'id'  => '26',
            ));
            Specialty::create(array(
                'name'  => 'Proctología',
                'id'  => '27',
            ));
            Specialty::create(array(
                'name'  => 'Psiquiatría',
                'id'  => '28',
            ));
            Specialty::create(array(
                'name'  => 'Rehabilitación',
                'id'  => '29',
            ));
            Specialty::create(array(
                'name'  => 'Reumatología',
                'id'  => '30',
            ));
            Specialty::create(array(
                'name'  => 'Traumatología',
                'id'  => '31',
            ));
            Specialty::create(array(
                'name'  => 'Toxicología',
                'id'  => '32',
            ));
            Specialty::create(array(
                'name'  => 'Urología',
                'id'  => '33',
            ));
            Specialty::create(array(
                'name'  => 'Oncología radioterápica',
                'id'  => '34',
            ));


	    }
	}

?>