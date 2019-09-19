<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        /** @var User $root */
        $root = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('password'),
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);

        $root->givePermissionTo([
            'api.enabled',
            'web_panel.enabled',
            'fts.enabled',
            'kahya.enabled',
        ]);

        /** @var User $test */
        $test = User::create([
            'name'      => 'Test',
            'email'     => 'test@test.com',
            'password'  => Hash::make('test'),
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);

    }
}
