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
        $routeScannerSettings = File::get('database' . DIRECTORY_SEPARATOR . 'service_route_scanner_settings.json');
        Service::create([
            'name'      => 'Kahya Instance',
            'type'      => ServiceType::CUSTOM_SERVICE,
            'status'    => ServiceStatus::IDLE,
            'settings'  => $routeScannerSettings,
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);

        $routeSyncBotSettings = File::get('database' . DIRECTORY_SEPARATOR . 'service_route_bot_settings.json');
        Service::create([
            'name'      => 'Route Sync Bot',
            'type'      => ServiceType::BOT,
            'status'    => ServiceStatus::IDLE,
            'settings'  => $routeSyncBotSettings,
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);

        $ftsBotSettings = File::get('database' . DIRECTORY_SEPARATOR . 'fts_bot_settings.json');
        Service::create([
            'name'      => 'FTS Bot',
            'type'      => ServiceType::BOT,
            'status'    => ServiceStatus::IDLE,
            'settings'  => $ftsBotSettings,
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);
    }
}
