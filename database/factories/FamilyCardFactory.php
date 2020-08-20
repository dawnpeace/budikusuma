<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FamilyCard;
use Faker\Generator as Faker;

$factory->define(FamilyCard::class, function (Faker $faker) {
    return [
        "id_card" => $faker->randomNumber(8), 
        "householder" => $faker->name(), 
        "householder_id_card" => $faker->randomNumber(8),
        "address" => $faker->address,
        "rt" => '01', 
        "rw" => '02', 
        "zip_code" => '78124', 
        "kelurahan" => "sanatab", 
        "kecamatan" => "sanatab", 
        "kabupaten" => "sanatab",
        "provinsi" => "Kalimantan Barat"
    ];
});
