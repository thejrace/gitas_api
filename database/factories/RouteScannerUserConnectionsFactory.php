<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RouteScanner;
use App\RouteScannerUserConnections;
use Faker\Generator as Faker;

$factory->define(RouteScannerUserConnections::class, function(Faker $faker) {
    return [
        'user_id'          => $faker->numberBetween(1, 150),
        'route_scanner_id' => factory(RouteScanner::class)->create()->id,
    ];
});
