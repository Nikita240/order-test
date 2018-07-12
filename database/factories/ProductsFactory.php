<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->company(),
        'cost' => $faker->numberBetween(1, 10000)
    ];
});
