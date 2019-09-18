<?php

use App\Enums\ServiceStatus;
use App\Enums\ServiceType;
use App\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $routeScannerSettings = File::get('database/service_route_scanner_settings.json');
        Service::create([
            'name'      => 'Kahya Instance',
            'type'      => ServiceType::ROUTE_SCANNER,
            'status'    => ServiceStatus::IDLE,
            'settings'  => $routeScannerSettings,
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);

        $routeSyncBotSettings = File::get('database/service_route_bot_settings.json');
        Service::create([
            'name'      => 'Route Sync Bot',
            'type'      => ServiceType::ROUTE_BOT,
            'status'    => ServiceStatus::IDLE,
            'settings'  => $routeSyncBotSettings,
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);
    }
}
