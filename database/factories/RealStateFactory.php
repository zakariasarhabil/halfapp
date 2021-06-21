<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RealState;
use Faker\Generator as Faker;

$factory->define(RealState::class, function (Faker $faker) {
    $office = App\OfficeOwner::all();

    return [
                "creator" => $faker->name,
                "type_offer" => $faker->name,
                "type_RealState" => $faker->name,
                "space" => $faker->numberBetween($min = 100, $max = 200),
                "price" => $faker->numberBetween($min = 100, $max = 200),
                "price_meter" => $faker->numberBetween($min = 100, $max = 200),
                "facade" => $faker->name,
                "location" => $faker->name,
                "evaluation" => $faker->name,
                "number_apartment" => $faker->numberBetween($min = 100, $max = 200),
                "furnished" => $faker->boolean(),
                "duplex" => $faker->boolean(),
                "driver_room" => $faker->boolean(),
                "addition" => $faker->boolean(),
                "cellar" => $faker->boolean(),
                "elevator" => $faker->boolean(),
                "magnifier" => $faker->boolean(),
                "specification" => $faker->text(),
                "number_offices" => $faker->numberBetween($min = 100, $max = 200),
                "type_owner" => $faker->name,

                "name_owner" => $faker->name,
                "phone" => $faker->phoneNumber(),
                'office_owners_id' => $office->random()->id,
    ];
});
