<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OfficeOwner;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(OfficeOwner::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'expired_at' => Carbon::instance($faker->dateTimeThisMonth())->toDateTimeString(),
        'voucher' => $faker->imageUrl($width= 500, $height = 500)
    ];
});
