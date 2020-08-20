<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BirthCertificate;
use Faker\Generator as Faker;

$factory->define(BirthCertificate::class, function (Faker $faker) {
    return [
        "id_card" => $faker->randomNumber(9),
        "name" => $faker->name, 
        "gender" => $faker->randomElement(['laki-laki', 'perempuan']), 
        "birthplace" => 'sanatab'
    ];
});
