<?php
use \Illuminate\Database\Seeder;
use Histoweb\Entities\Doctor;

class DoctorsTableSeeder extends Seeder{

        private static $doctors = [
            [
                'cc'                    => 1,
                'first_name'            => 'Miguel',
                'last_name'             => 'Mejía',
                'telemedicine'          => 1,
                'user_id'               => 5,
                'specialty_id'          => 2,
            ],
            [
                'cc'                    => 1121907154,
                'first_name'            => 'Andrés Felipe',
                'last_name'             => 'Ardila Rivas',
                'telemedicine'          => 1,
                'user_id'               => 7,
                'specialty_id'          => 2,
            ],

        ];
        
        public function run()
        {
            foreach (self::$doctors as $type) {
                Doctor::create([
                    'cc'                    => $type['cc'],
                    'first_name'            => $type['first_name'],
                    'last_name'             => $type['last_name'],
                    'telemedicine'          => $type['telemedicine'],
                    'user_id'               => $type['user_id'],
                    'specialty_id'          => $type['specialty_id'],
                ]);
            }
        }

} 