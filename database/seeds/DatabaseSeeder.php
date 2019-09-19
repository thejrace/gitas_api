<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(PermissionTypesSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
//        $this->call(RoutesTableSeeder::class);
//        $this->call(RouteStopsTableSeeder::class);
//        $this->call(RouteIntersectionsTableSeeder::class);
    }
}
