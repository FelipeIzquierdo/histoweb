<?php  

	use Illuminate\Database\Seeder;
	use Illuminate\Database\Eloquent\Model;
    use Faker\Factory as Faker;

	class SurgeriesTableSeeder extends Seeder
	{
		public function run()
	    {
            $faker = Faker::create();
            foreach(range(1, 30) as $index) {
                DB::table('surgeries')->insert(array(
                    'name' => 'Consultorio_'.$index
                ));
                DB::table('surgery_tool')->insert(array(
                    'surgery_id' => $index,
                    'tool_id' => $faker->numberBetween($min = 1, $max = 9)
                ));
            }
	    }
	}
?>