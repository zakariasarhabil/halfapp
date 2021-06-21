<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Request;
use Faker\Generator as Faker;

$factory->define(Request::class, function (Faker $faker) {
    $office = App\OfficeOwner::all();
    $marketer = App\Marketer::all();
    return [

        "name_client" => $faker->name,
        "number" =>  $faker->numberBetween($min = 100, $max = 200),
        "type_realstate" => $faker->name,
        "type_request" => $faker->name,
        "space_min" => $faker->numberBetween($min = 100, $max = 200),
        "space_max" => $faker->numberBetween($min = 100, $max = 200),
        "price_min" => $faker->numberBetween($min = 100, $max = 200),
        "price_max" => $faker->numberBetween($min = 100, $max = 200),
        "information" => $faker->text,
        "status" => $faker->name,

        'office_owners_id' => $office->random()->id,
        'marketers_id' => $marketer->random()->id,
    ];
});
