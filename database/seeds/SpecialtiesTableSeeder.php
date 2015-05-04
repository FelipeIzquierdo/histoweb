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
	        ));
            Specialty::create(array(
                'name'  => 'Anestesiología y reanimación',
            ));
            Specialty::create(array(
                'name'  => 'Cardiología',
            ));
            Specialty::create(array(
                'name'  => 'Gastroenterología',
            ));
            Specialty::create(array(
                'name'  => 'Endocrinología',
            ));
            Specialty::create(array(
                'name'  => 'Geriatría',
            ));
            Specialty::create(array(
                'name'  => 'Hematología y hemoterapia',
            ));
            Specialty::create(array(
                'name'  => 'Hidrología médica',
            ));
            Specialty::create(array(
                'name'  => 'Infectología',
            ));
            Specialty::create(array(
                'name'  => 'Medicina aeroespacial',
            ));
            Specialty::create(array(
                'name'  => 'Medicina del deporte',
            ));
            Specialty::create(array(
                'name'  => 'Medicina del trabajo',
            ));
            Specialty::create(array(
                'name'  => 'Medicina de urgencias',
            ));
            Specialty::create(array(
                'name'  => 'Medicina familiar y comunitaria',
            ));
            Specialty::create(array(
                'name'  => 'Medicina intensiva',
            ));
            Specialty::create(array(
                'name'  => 'Medicina interna',
            ));
            Specialty::create(array(
                'name'  => 'Medicina legal y forense',
            ));
            Specialty::create(array(
                'name'  => 'Medicina preventiva y salud pública',
            ));
            Specialty::create(array(
                'name'  => 'Neumología',
            ));
            Specialty::create(array(
                'name'  => 'Neurología',
            ));
            Specialty::create(array(
                'name'  => 'Nutriología',
            ));
            Specialty::create(array(
                'name'  => 'Odontología',
            ));
            Specialty::create(array(
                'name'  => 'Oftalmología',
            ));
            Specialty::create(array(
                'name'  => 'Oncología médica',
            ));
            Specialty::create(array(
                'name'  => 'Oncología radioterápica',
            ));
            Specialty::create(array(
                'name'  => 'Otorrinolaringología',
            ));
            Specialty::create(array(
                'name'  => 'Pediatría',
            ));
            Specialty::create(array(
                'name'  => 'Proctología',
            ));
            Specialty::create(array(
                'name'  => 'Psiquiatría',
            ));
            Specialty::create(array(
                'name'  => 'Rehabilitación',
            ));
            Specialty::create(array(
                'name'  => 'Reumatología',
            ));
            Specialty::create(array(
                'name'  => 'Traumatología',
            ));
            Specialty::create(array(
                'name'  => 'Toxicología',
            ));
            Specialty::create(array(
                'name'  => 'Urología',
            ));


	    }
	}

?>