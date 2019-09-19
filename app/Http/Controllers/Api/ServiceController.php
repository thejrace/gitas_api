<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreFormRequest;
use App\Http\Requests\ServiceUpdateFormRequest;
use App\Http\Resources\Api\ServiceResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Service;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ServiceResource::collection(Service::all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return ServiceResource
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return new ServiceResource($service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ServiceStoreFormRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(ServiceStoreFormRequest $request)
    {
        $attributes              = $request->all();
        $attributes['api_token'] = Str::random(60);

        Service::create($attributes);

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceUpdateFormRequest $request
     * @param int                      $id
     *
     * @return SuccessJSONResponseResource
     */
    public function update(ServiceUpdateFormRequest $request, $id)
    {
        $service = Service::findOrFail($id);

        $service->update($request->all());

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return new SuccessJSONResponseResource(null);
    }
}
