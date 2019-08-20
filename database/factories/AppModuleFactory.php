<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\AppModule;
use Faker\Generator as Faker;

$factory->define(AppModule::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'permission_prefix' => strtolower($faker->firstName),
        'description' => $faker->colorName,
        'api_token' => \Illuminate\Support\Str::random(60),
    ];
});
