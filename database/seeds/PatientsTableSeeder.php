<?php
use \Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Histoweb\Entities\Diary;


class PatientsTableSeeder extends Seeder{

    public function  run(){
/*
        $faker = Faker::create();

        foreach(range(1, 30) as $index)
        {
            $patient_id = \DB::table('patients')->insertGetId(array(
                'doc'               => $faker->unique()->numberBetween($min = 1000, $max = 9000),
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'sex'               => 'M',
                'tel'               => $faker->phoneNumber,
                'email'             => $faker->email,
                'date_birth'        => '01-10-1990',
                'doc_type_id'          =>  1,
                'occupation_id'        =>  1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime 
            ));

            $start = $faker->dateTimeBetween('-2 days', '+15 hours');
            $end = $start->add(new DateInterval('PT1H'));

            $diary_id = \DB::table('diaries')->insertGetId(array(
                'patient_id'        => $patient_id,
                'doctor_id'         => 1,
                'type_id'           => 1,
                'start'             => $start,
                'end'               => $end, 
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime 
            ));

            //Diary::find($diary_id)->createEntry();

        }*/
    }

} 