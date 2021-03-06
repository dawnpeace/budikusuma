<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DeathCertificate;
use Faker\Generator as Faker;
use App\enums\DocumentStatus;
use App\enums\Gender;

$factory->define(DeathCertificate::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "card_number" => $faker->randomNumber(8),
        "identity_card" => $faker->randomNumber(8),
        "birthdate" => "1990-01-01",
        "birthplace" => "sanatab",
        "deceased_at" => $faker->dateTimeBetween('-10 years'),
        "note" => $faker->text(50),
        "gender" => $faker->randomElement(Gender::ALL),
        "status" => $faker->randomElement(DocumentStatus::DONE)
    ];
});
