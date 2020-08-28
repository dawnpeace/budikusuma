<?php

use Illuminate\Database\Seeder;

class BirthCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i = 0; $i < 10; $i++){
            $randNum = random_int(1,3);
            $motherIdCard = $faker->randomNumber(8);
            $motherName = $faker->name(['woman']);
            $fatherName = $faker->name(['man']);
            $fatherIdCard = $faker->randomNumber(8);
            $birthdate = $faker->date('Y-m-d', '1990-01-30');
            factory(App\BirthCertificate::class,$randNum)->create([
                "mother_identity_card_number" => $motherIdCard,
                "birthdate" => $birthdate,
                "mother_name" => $motherName,
                "father_identity_card_number" => $fatherIdCard,
                "father_name" => $fatherName
            ]);
        }
    }
}
