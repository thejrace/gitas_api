<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\PermissionType;
use Faker\Generator as Faker;

$factory->define(PermissionType::class, function(Faker $faker) {
    return [
        'name'        => $faker->colorName,
        'description' => $faker->text(100),
    ];
});
