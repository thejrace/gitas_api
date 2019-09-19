<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RouteScanner;
use Faker\Generator as Faker;

$factory->define(RouteScanner::class, function(Faker $faker) {
    return [
        'code'     => $faker->colorName,
        'status'   => $faker->numberBetween(0, 1),
        'settings' => '{}',
    ];
});
