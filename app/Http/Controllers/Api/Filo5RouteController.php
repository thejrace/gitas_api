<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

class Filo5RouteController extends Controller
{
    public function index()
    {
        try {
            $data = json_decode(File::get(base_path() . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'filo5_routes.json'));

            return response()->json([
                //'routes' => ['15BK', '14M', '11ÜS'],
                'routes' => $data,
            ]);
        } catch (FileNotFoundException $e) {
            return response(['error' => true, 'meessage' => $e->getMessage()]);
        }
    }
}
