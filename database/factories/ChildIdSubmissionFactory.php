<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ChildIdSubmission;
use Faker\Generator as Faker;

$factory->define(ChildIdSubmission::class, function (Faker $faker) {
    return [
        "card_number" => $faker->randomNumber(8),
        "name" => $faker->name,
        "gender" => $faker->randomElement(["laki-laki", "perempuan"]),
        "family_card_number" => $faker->randomNumber(8),
        "birth_certificate_number" => $faker->randomNumber(8),
        "birthplace" => "sanatab",
        "birthdate" => "1990-01-01",
        "householder_name" => $faker->name(),
        "religion" => $faker->randomElement(["kristen protestan", "kristen katolik", "islam", "buddha", "konghucu"]),
        "address" => $faker->address,
        "rt" => "01",
        "rw" => "02",
        "kelurahan" => "Sanatab",
        "kecamatan" => "Sanatab",
        "citizenship" => "WNI"
    ];
});
