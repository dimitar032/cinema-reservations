<?php

use Faker\Generator as Faker;

$factory->define(\App\Movie::class, function (Faker $faker) {
    static $name;
    static $date;
    static $duration;

    return [
        'name' => $name ?: $faker->name,
        'description' => $faker->text(),
        'premiere_date' => $date ?: $faker->date(),
        'duration' => $duration ?: $faker->numberBetween(60, 180),
    ];

});
