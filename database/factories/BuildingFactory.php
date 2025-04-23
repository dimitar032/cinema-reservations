<?php

use Faker\Generator as Faker;

$factory->define(\App\Building::class, function (Faker $faker) {
    static $name;
    static $user_id;

    return [
        'name' => $name ?: $faker->name,
        'longitude' => $faker->numberBetween(1, 255),
        'latitude' => $faker->numberBetween(1, 255),
        'user_id' => $user_id
    ];
});
