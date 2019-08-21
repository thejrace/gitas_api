<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\AppModule;
use App\AppModuleUser;
use Faker\Generator as Faker;

$factory->define(AppModuleUser::class, function(Faker $faker) {
    return [
        'name'          => $faker->name,
        'email'         => $faker->email,
        'password'      => Hash::make($faker->password),
        'app_module_id' => factory(AppModule::class)->create()->id,
        'api_token'     => \Illuminate\Support\Str::random(60),
    ];
});
