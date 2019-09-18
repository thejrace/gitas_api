<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function(Faker $faker) {
    return [
        'type'      => $faker->numberBetween(0, 1),
        'name'      => $faker->name,
        'status'    => $faker->numberBetween(0, 1),
        'settings'  => '{}',
        'api_token' => \Illuminate\Support\Str::random(60),
    ];
});
