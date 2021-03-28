<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FamilyCardSubmission;
use Faker\Generator as Faker;

$factory->define(FamilyCardSubmission::class, function (Faker $faker) {
    return [
        "id_number" => $faker->randomNumber(8),
        "householder" => $faker->name(),
        "householder_id_card" => $faker->randomNumber(8),
        "address" => $faker->address,
        "rt" => '01',
        "rw" => '02',
        "zipcode" => '78124',
        "kelurahan" => "sanatab",
        "kecamatan" => "sanatab",
        "kabupaten" => "sanatab",
        "provinsi" => "Kalimantan Barat",
        "user_id" => 1
    ];
});
