<?php

    /** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Score::class, function (Faker $faker) {
    return [
        'points' => $faker->randomFloat(4, 0.0001, 1),
        'user_id' => $faker->numberBetween(1, 10),
    ];
});
