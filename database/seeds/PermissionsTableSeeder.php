<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permission::create([
            'name'        => 'web_panel.enabled',
            'guard_name'  => 'api',
            'type'        => 1,
            'description' => 'Web kontrol panelini kullanabilir.',
        ]);

        Permission::create([
            'name'        => 'api.enabled',
            'guard_name'  => 'api',
            'type'        => 1,
            'description' => 'Gitaş API kullanabilir.',
        ]);

        Permission::create([
            'name'        => 'fts.enabled',
            'guard_name'  => 'api',
            'type'        => 1,
            'description' => 'FTS kullanabilir.',
        ]);

        Permission::create([
            'name'        => 'kahya.enabled',
            'guard_name'  => 'api',
            'type'        => 1,
            'description' => 'Kahya kullanabilir.',
        ]);
    }
}
