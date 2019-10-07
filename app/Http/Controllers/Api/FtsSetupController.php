<?php

namespace App\Http\Controllers\Api;

use App\FtsVersion;
use App\Http\Controllers\Controller;

class FtsSetupController extends Controller
{
    /**
     * Return the required data for setup action
     */
    public function getApplicationData()
    {
        return response()->json([
            'download_url'        => 'http://gitas_api.test/storage/fts_download/GFTS.json',
            'helper_download_url' => 'http://gitas_api.test/storage/fts_download/helpers/fts_update_helper.jar',
            'app_config'          => [
                'base_api' => [
                    'http://gitas_api.test/api/',
                    'http://gitfilo.com/api',
                ],
                'cookie_agent_urls' => [
                    'http://192.168.2.177/filotakip/get_cookie?key=nJAHJjksd13',
                    'http://gitsistem.com/filotakip/get_cookie?key=nJAHJjksd13',
                ],
            ],
            'settings' => [
                'data_source'             => 0,  // 0 -> filo, 1 -> server
                'data_download_frequency' => 60,
                'alert_frequency'         => 60,
                'alert_visible_delay'     => 30,
                'bus_box_template'        => 1,  // 1, 2, 3
                'alert_filters'           => [],
                'filters'                 => [],
            ],
        ]);
    }

    /**
     * Get last version number x.x.x
     */
    public function getLastVersion()
    {
        /** @var FtsVersion $lastVersion */
        $lastVersion = FtsVersion::latest()
            ->first();

        return response()->json([
            'last_version' => $lastVersion->fullVersion('.'),
        ]);
    }
}
