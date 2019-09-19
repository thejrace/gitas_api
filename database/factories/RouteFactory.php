<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Route;
use Faker\Generator as Faker;

$factory->define(Route::class, function(Faker $faker) {
    return [
        'code' => Str::random(3),
        'name' => Str::random(50),
    ];
});
