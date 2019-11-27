<?php

use App\RouteStop;
use Illuminate\Database\Seeder;

class RouteStopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = json_decode(File::get('database' . DIRECTORY_SEPARATOR . 'route_stops.json'));

        foreach ($data as $stop) {
            RouteStop::create([
                'route_id'  => $stop->route_id,
                'no'        => $stop->no,
                'name'      => $stop->name,
                'direction' => $stop->direction,
            ]);
        }
    }
}
