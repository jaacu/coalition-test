<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'stock' => random_int(0,100),
        'price' => $faker->randomFloat( 3, 0, 100000 ),
    ];
});
