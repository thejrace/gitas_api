<?php

use App\AppModule;
use Illuminate\Database\Seeder;

class AppModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = AppModule::create(array(
            "name"              => "Obarey Bot",
            "permission_prefix" => "obarey_bot",
            "api_token"         => \Illuminate\Support\Str::random(60)
        ));
        $root->assignRole('app_module');
    }
}
