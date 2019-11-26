<?php

namespace App\Http\Controllers\Api;

use App\FtsVersion;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

class FtsSetupController extends Controller
{
    /**
     * Return the required data for setup action
     */
    public function getApplicationData()
    {
        try {
            $applicationDataConfig = json_decode(File::get(base_path() . '/database/fts_app_settings_template.json'), true);
        } catch (FileNotFoundException $e) {
            return response()->json([
                'error' => true,
            ]);
        }
        return response()->json($applicationDataConfig);
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
