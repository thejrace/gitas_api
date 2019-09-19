<?php

namespace Tests\Feature\ServicePipeline;

use App\Enums\RouteDirection;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Route;
use App\Service;
use Tests\ApiTestCase;

class RouteScannerDataDownloadTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/servicePipeline/updateRouteIntersections/';
    }
}
