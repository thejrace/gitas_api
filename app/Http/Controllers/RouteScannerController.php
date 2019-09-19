<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteScannerController extends Controller
{
    /**
     * Show index view
     *
     *
     * @return \View
     */
    public function index(Request $request)
    {
        return view('routescanners');
    }
}
