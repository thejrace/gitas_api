<?php

use App\PermissionType;
use Illuminate\Database\Seeder;

class PermissionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionType::create([
            'name' => 'Kullanıcı İzinleri',
            'description' => 'API and Web kullanıcılar izinleri.'
        ]);
        PermissionType::create([
            'name' => 'Modül İzinleri',
            'description' => 'Modül kullanıcıları izinleri.'
        ]);
    }
}
