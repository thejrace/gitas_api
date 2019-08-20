<?php

use App\AppModuleUser;
use Illuminate\Database\Seeder;

class AppModuleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = AppModuleUser::create(array(
            "name"              => "Obarey Test User",
            "email"             => "obarey@obarey.com",
            "password"          => Hash::make("password"),
            "app_module_id"     => 1, // obarey test module
            "api_token"         => \Illuminate\Support\Str::random(60)
        ));
        $root->assignRole('app_module_user');
    }
}
