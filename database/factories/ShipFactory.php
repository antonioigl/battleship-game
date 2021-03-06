<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Ship::class, function (Faker $faker) {
    return [
        'x' => $faker->numberBetween(1, 10),
        'y' => $faker->numberBetween(1, 10),
        'axis'=> $faker->randomElement(['H', 'V']),
        'length'=> $faker->numberBetween(2, 5),
        'shot_counter'=> $faker->numberBetween(0, 5),
        'user_id' =>$faker->numberBetween(1, 10),
    ];
});
