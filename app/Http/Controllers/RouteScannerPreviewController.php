<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteScannerPreviewController extends Controller
{
    public function index(Request $request, $route)
    {
        return view('kahya_preview')->with([
            'routeCode' => $route,
        ]);
    }
}
