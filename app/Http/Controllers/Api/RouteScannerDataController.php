<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessJSONResponseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RouteScannerDataController extends Controller
{
    /**
     * Returns the data of the route scanner
     *
     * @param Request $request
     * @param string  $route
     */
    public function show(Request $request, $route)
    {
    }

    /**
     * @param Request $request
     * @param $route
     *
     * @return SuccessJSONResponseResource
     */
    public function upload(Request $request)
    {
        $data = $request->input('data');

        $route = json_decode($data, 'true')['routeCode'];

        Storage::put($route . '.json', $data, 'public');

        return new SuccessJSONResponseResource(null);
    }

    public function download(Request $request, $route)
    {
        return Storage::get($route . '.json');
    }
}
