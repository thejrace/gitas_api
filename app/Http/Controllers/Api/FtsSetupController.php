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
        // get last version
        /** @var FtsVersion $lastVersion */
        $lastVersion = FtsVersion::latest()
            ->first();

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
