<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'status' => $faker->numberBetween(0, 1),
    ];
});
