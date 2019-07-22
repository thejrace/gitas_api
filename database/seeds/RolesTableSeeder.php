<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleBot = Role::create(['name' => 'module_bot', 'guard_name' => 'api']);
        $adminRole = Role::create(['name' => 'admin',  'guard_name' => 'api']);
        $standartUserRole = Role::create(['name' => 'std_user',  'guard_name' => 'api']);
    }
}
