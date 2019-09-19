<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Route;
use App\RouteStop;
use Faker\Generator as Faker;

$factory->define(RouteStop::class, function(Faker $faker) {
    return [
        'route_id'  => factory(Route::class)->create()->id,
        'no'        => $faker->numberBetween(0, 50),
        'name'      => $faker->colorName,
        'direction' => $faker->numberBetween(0, 1),
    ];
});
