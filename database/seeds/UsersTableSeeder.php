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
        $root = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('password'),
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);
        $root->assignRole('admin');
    }
}
