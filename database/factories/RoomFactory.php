<?php

use Faker\Generator as Faker;

$factory->define(\App\Room::class, function (Faker $faker) {
    static $name;
    static $building_id;

    return [
        'name' => $name ?: $faker->name,
        'building_id' => $building_id,
    ];
});
