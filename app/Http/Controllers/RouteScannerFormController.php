<?php

namespace App\Http\Controllers;

use App\RouteScanner;
use Illuminate\Http\Request;

class RouteScannerFormController extends Controller
{
    /**
     * Return Create form
     *
     * @param Request $request;
     *
     * @return \View
     */
    public function create(Request $request)
    {
        return view('routescanner_form');
    }

    /**
     * Return edit form
     *
     * @param RouteScanner $routeScanner
     *
     * @return \View
     */
    public function edit(RouteScanner $routeScanner)
    {
        return view('routescanner_form')->with([
            'dataId' => $routeScanner->id,
        ]);
    }
}
