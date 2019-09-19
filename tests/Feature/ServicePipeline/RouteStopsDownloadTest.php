<?php

namespace Tests\Feature;

use App\Route;
use App\RouteStop;
use App\Service;
use Tests\ApiTestCase;

class RouteStopsDownloadTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/servicePipeline/routeScanner/routeStops/';
    }

    /** @test */
    public function it_requires_authentication()
    {
        $this->getJson($this->url())
            ->assertStatus(401)
            ->assertExactJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    /** @test */
    public function it_returns_stops()
    {
        /** @var Service $service */
        $service = factory(Service::class)->create();

        $this->actingAs($service, 'service');

        /** @var Route $route */
        $route = factory(Route::class)->create();

        /** @var RouteStop $stop */
        $stop = factory(RouteStop::class)->create([
            'route_id' => $route->id,
        ]);

        $this->getJson($this->url() . '?routeCode=' . $route->code)
            ->assertSuccessful()
            ->assertJsonFragment([
                'route'     => $stop->route->code,
                'no'        => $stop->no,
                'direction' => $stop->direction,
                'name'      => $stop->name,
            ]);
    }
}
