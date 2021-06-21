<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\image;
use Faker\Generator as Faker;

$factory->define(image::class, function (Faker $faker) {
    $real = App\RealState::all();
    return [
        'path' => $faker->text,
        'image_url' => $faker->text,
        'name' => $faker->name,
        'real_states_id' => $real->random()->id
    ];
});
