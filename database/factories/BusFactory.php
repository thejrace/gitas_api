<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Bus;
use Faker\Generator as Faker;

$factory->define(Bus::class, function(Faker $faker) {
    return [
        'active_plate'   => $faker->text(15),
        'official_plate' => $faker->text(15),
        'code'           => $faker->text(6),
    ];
});
