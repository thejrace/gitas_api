<?php

use App\Enums\RouteScannerStatus;
use App\RouteScanner;
use Illuminate\Database\Seeder;

class RouteScannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run()
    {
        $data = json_decode(File::get('database/filo5_routes.json'));

        foreach ($data as $route) {
            RouteScanner::create([
                'code'   => $route,
                'status' => RouteScannerStatus::ACTIVE,
            ]);
        }
    }
}
