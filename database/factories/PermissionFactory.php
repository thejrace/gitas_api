<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Spatie\Permission\Models\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'type' => $faker->numberBetween(0,1),
        'description' => $faker->text(100),
        'guard_name' => 'api', // will be replaced for tests
    ];
});
