<?php

use Faker\Generator as Faker;

$factory->define(App\Shot::class, function (Faker $faker) {
    return [
        'x' => $faker->numberBetween(1, 10),
        'y' => $faker->numberBetween(1, 10),
        'user_id' =>$faker->numberBetween(1, 10),
    ];
});
