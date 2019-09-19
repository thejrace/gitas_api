<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Route;
use App\RouteIntersection;
use Faker\Generator as Faker;

$factory->define(RouteIntersection::class, function(Faker $faker) {
    return [
        'active_route_id'      => factory(Route::class)->create()->id,
        'intersected_route_id' => factory(Route::class)->create()->id,
        'direction'            => $faker->numberBetween(0, 1),
        'stop_name'            => $faker->colorName,
        'total_diff'           => $faker->numberBetween(0, 50),
    ];
});
