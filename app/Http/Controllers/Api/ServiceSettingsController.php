<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ServiceSettingsRequest;
use App\Http\Resources\Api\ServiceSettingsResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Service;
use Illuminate\Http\Request;

class ServiceSettingsController extends Controller
{
    /**
     * Display the specified resource settings.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return ServiceSettingsResource
     */
    public function show(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        return new ServiceSettingsResource($service);
    }

    /**
     * Update the service settings.
     *
     * @param ServiceSettingsRequest $request
     * @param int                    $id
     *
     * @return SuccessJSONResponseResource
     */
    public function updateSettings(ServiceSettingsRequest $request, $id)
    {
        $service = Service::findOrFail($id);

        $service->update($request->only(['settings']));

        return new SuccessJSONResponseResource(null);
    }

    public function updateStatus(ServiceSettingsRequest $request, $id)
    {
        $service = Service::findOrFail($id);

        $service->update($request->only(['status']));

        return new SuccessJSONResponseResource(null);
    }
}
