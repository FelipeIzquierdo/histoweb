<?php
use \Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class PatientsTableSeeder extends Seeder{

    public function  run(){

        $faker = Faker::create();

        foreach(range(1, 30) as $index)
        {
            \DB::table('patients')->insertGetId(array(
                'doc'               => $faker->unique()->numberBetween($min = 1000, $max = 9000),
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'sex'               => 'M',
                'tel'               => $faker->phoneNumber,
                'email'             => $faker->email,
                'date_birth'     => '01-10-1990',
                'doc_type_id'          =>  1,
                'occupation_id'        =>  1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime 
            ));
        }
    }

} 