<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BirthCertificateSubmission;
use Faker\Generator as Faker;

$factory->define(BirthCertificateSubmission::class, function (Faker $faker) {
    return [
        "id_card" => $faker->randomNumber(9),
        "name" => $faker->name,
        "gender" => $faker->randomElement(['laki-laki', 'perempuan']),
        "birthplace" => $faker->city,
        "family_card_number" => $faker->randomNumber(9),
        "birthdate" => '1990-01-01',
        "mother_identity_card_number" => $faker->randomNumber(9),
        "mother_name" => $faker->name(),
        "father_identity_card_number" => $faker->randomNumber(9),
        "father_name" => $faker->name(),
    ];
});
