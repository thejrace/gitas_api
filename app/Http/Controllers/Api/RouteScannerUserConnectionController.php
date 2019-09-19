<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessJSONResponseResource;
use App\RouteScannerUserConnections;
use Illuminate\Database\Query\Builder;

class RouteScannerUserConnectionController extends Controller
{
    /**
     * Store a newly created model in storage.
     *
     * @param int $userId
     * @param int $routeScannerId
     *
     * @return SuccessJSONResponseResource
     */
    public function store($userId, $routeScannerId)
    {
        $attributes = [
            'user_id'          => $userId,
            'route_scanner_id' => $routeScannerId,
        ];
        RouteScannerUserConnections::create($attributes);

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove app module
     *
     * @param int $userId
     * @param int $routeScannerId
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception|\Throwable
     */
    public function destroy($userId, $routeScannerId)
    {
        $query = RouteScannerUserConnections::query();
        /* @var Builder $query */
        $query->where('user_id', $userId)
            ->where('route_scanner_id', $routeScannerId);

        $query->first()->delete();

        return new SuccessJSONResponseResource(null);
    }
}
