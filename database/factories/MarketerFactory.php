<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Marketer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Marketer::class, function (Faker $faker) {
    $office = App\OfficeOwner::all();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'office_owners_id' => $office->random()->id,
    ];
});
