<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceSettingsController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        return view('service_settings')->with([
            'dataId'      => $id,
            'serviceName' => $service->name,
        ]);
    }
}
