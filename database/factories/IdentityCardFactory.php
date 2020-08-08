<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IdentityCard;
use Faker\Generator as Faker;

$factory->define(IdentityCard::class, function (Faker $faker) {
    return [
        "identity_card_number" => $faker->numberBetween(1000, 5000), 
        "name" => $faker->name(), 
        "gender" => $faker->randomElement(["laki-laki", "perempuan"]), 
        "address" => $faker->address,
        "birthplace" => $faker->city, 
        "birthdate" => '1990-01-01', 
        "rt" => "01", 
        "rw" => "02", 
        "kelurahan" => $faker->citySuffix,
        "kecamatan" => $faker->country, 
        "religion" => $faker->randomElement(["kristen protestan", "kristen katolik", "islam", "buddha", "konghucu"]), 
        "marriage_status" => $faker->randomElement(["not_married", "married", "widowed"]), 
        "profession" => $faker->jobTitle, 
        "nationality" => "WNI"
    ];
});
