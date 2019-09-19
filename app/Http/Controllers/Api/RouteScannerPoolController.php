<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RouteScannerPoolResource;
use App\RouteScanner;

class RouteScannerPoolController extends Controller
{
    /**
     * Get all route scanners
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return RouteScannerPoolResource::collection(RouteScanner::all());
    }
}
