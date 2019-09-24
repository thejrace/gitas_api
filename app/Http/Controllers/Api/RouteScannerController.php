<?php

namespace App\Http\Controllers\Api;

use App\Enums\ServiceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RouteScannerStoreFormRequest;
use App\Http\Requests\Api\RouteScannerUpdateFormRequest;
use App\Http\Resources\Api\RouteScannerResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\RouteScanner;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RouteScannerController extends Controller
{
    /**
     * Get all RouteScanners
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return RouteScannerResource::collection(RouteScanner::all());
    }

    /**
     * Display the specified resource.
     *
     * @param RouteScanner $model
     *
     * @return RouteScannerResource
     */
    public function show(RouteScanner $model)
    {
        return new RouteScannerResource($model);
    }

    /**
     * Store a newly created model in storage.
     *
     * @param RouteScannerStoreFormRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(RouteScannerStoreFormRequest $request)
    {
        RouteScanner::create($request->all());

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified location in storage.
     *
     * @param RouteScannerUpdateFormRequest $request
     * @param RouteScanner                  $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(RouteScannerUpdateFormRequest $request, RouteScanner $model)
    {
        $model->update($request->all());

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Start the given scanner
     *
     * @param RouteScanner $model
     *
     * @return SuccessJSONResponseResource
     */
    public function start(RouteScanner $model)
    {
        $model->update(['status' => ServiceStatus::ACTIVE]);

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Stop the given scanner
     *
     * @param RouteScanner $model
     *
     * @return SuccessJSONResponseResource
     */
    public function stop(RouteScanner $model)
    {
        $model->update(['status' => ServiceStatus::IDLE]);

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Start all scanners
     *
     * @return SuccessJSONResponseResource
     */
    public function startAll()
    {
        RouteScanner::where('status', ServiceStatus::IDLE)
            ->update(['status' => ServiceStatus::ACTIVE]);

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Stop all scanners
     *
     * @return SuccessJSONResponseResource
     */
    public function stopAll()
    {
        RouteScanner::where('status', ServiceStatus::ACTIVE)
            ->update(['status' => ServiceStatus::IDLE]);

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove resource
     *
     * @param RouteScanner $model
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(RouteScanner $model)
    {
        $model->delete();

        return new SuccessJSONResponseResource(null);
    }
}
