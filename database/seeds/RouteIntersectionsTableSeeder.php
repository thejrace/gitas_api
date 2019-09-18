<?php

use App\RouteIntersection;
use Illuminate\Database\Seeder;

class RouteIntersectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = json_decode(File::get('database/route_intersections.json'));

        foreach ($data as $stop) {
            RouteIntersection::create([
                'active_route_id'      => $stop->active_route_id,
                'intersected_route_id' => $stop->intersected_route_id,
                'stop_name'            => $stop->stop_name,
                'direction'            => $stop->direction,
                'total_diff'           => $stop->total_diff,
            ]);
        }
    }
}
