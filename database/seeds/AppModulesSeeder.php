<?php

use App\AppModule;
use Illuminate\Database\Seeder;

class AppModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $root = AppModule::create([
            'name'              => 'Obarey Bot',
            'permission_prefix' => 'obarey_bot',
            'api_token'         => \Illuminate\Support\Str::random(60),
        ]);
        $root->assignRole('app_module');
    }
}
