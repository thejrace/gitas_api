<?php

namespace Tests\Feature;

use App\Route;
use App\RouteIntersection;
use App\Service;
use Tests\ApiTestCase;

class RouteIntersectionsDownloadTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/servicePipeline/routeScanner/routeIntersections/';
    }

    /** @test */
    public function it_requires_authentication()
    {
        $this->getJson($this->url() . '1')
            ->assertStatus(401)
            ->assertExactJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    /** @test */
    public function it_returns_intersections()
    {
        /** @var Service $service */
        $service = factory(Service::class)->create();

        $this->actingAs($service, 'service');

        /** @var Route $activeRoute */
        $activeRoute = factory(Route::class)->create();

        /** @var Route $intersectedRoute */
        $intersectedRoute = factory(Route::class)->create();

        /** @var RouteIntersection $intersection */
        $intersection = factory(RouteIntersection::class)->create([
            'active_route_id'      => $activeRoute->id,
            'intersected_route_id' => $intersectedRoute->id,
        ]);

        $this->getJson($this->url() . $activeRoute->code)
            ->assertSuccessful()->dump()
            ->assertJsonFragment([
                'intersected_route' => $intersection->intersectedRoute->code,
                'direction'         => $intersection->direction,
                'stop_name'         => $intersection->stop_name,
                'total_diff'        => $intersection->total_diff,
            ]);
    }
}
