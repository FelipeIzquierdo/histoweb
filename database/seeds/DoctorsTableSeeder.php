<?php
use \Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class DoctorsTableSeeder extends Seeder{

    public function  run(){

        $faker = Faker::create();

        foreach(range(1, 30) as $index)
        {
            \DB::table('doctors')->insertGetId(array(
                'cc'              => $faker->unique()->numberBetween($min = 1000, $max = 9000),
                'first_name'      => $faker->firstName,
                'last_name'       => $faker->lastName,
                'color'           => $faker->unique()->hexcolor,
                'specialty_id'    => $faker->numberBetween($min = 1, $max = 34),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime 
            ));
        }
    }

} 