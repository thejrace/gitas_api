<?php

use Illuminate\Database\Seeder;
use App\Route;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run()
    {
        $data = json_decode(File::get('database'.DIRECTORY_SEPARATOR.'routes.json'));

        foreach ($data as $route) {
            Route::create([
               'code' => $route->code,
               'name' => $route->name,
            ]);
        }
    }
}
