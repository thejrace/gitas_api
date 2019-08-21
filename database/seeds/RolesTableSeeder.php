<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create(['name' => 'app_module', 'guard_name' => 'app_module']);
        Role::create(['name' => 'app_module_user', 'guard_name' => 'app_module_user']);
        Role::create(['name' => 'admin',  'guard_name' => 'api']);
        Role::create(['name' => 'admin',  'guard_name' => 'web']);
    }
}
