<?php

namespace Tests\Feature\ServicePipeline;

use App\Enums\RouteDirection;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Route;
use App\Service;
use Tests\ApiTestCase;

class RouteIntersectionServiceTest extends ApiTestCase
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

    /** @test */
    public function it_requires_authentication()
    {
        $this->putJson($this->url())
            ->assertStatus(401)
            ->assertExactJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    /** @test */
    public function it_updates_route_intersections()
    {
        /** @var Service $service */
        $service = factory(Service::class)->create();

        $this->actingAs($service, 'service');

        /** @var Route $activeRoute */
        $activeRoute = factory(Route::class)->create();

        /** @var Route $intersectedRoute */
        $intersectedRoute = factory(Route::class)->create();

        $routeData = [
            'active_route'      => $activeRoute->code,
            'intersected_route' => $intersectedRoute->code,
            'direction'         => RouteDirection::FORWARD,
            'stop_name'         => 'NUMUNE HASTANESİ',
            'total_diff'        => 5,
        ];

        $this->putJson($this->url(), ['data' => json_encode($routeData)])
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('route_intersections', [
            'active_route_id'      => $activeRoute->id,
            'intersected_route_id' => $intersectedRoute->id,
            'direction'            => RouteDirection::FORWARD,
            'stop_name'            => 'NUMUNE HASTANESİ',
            'total_diff'           => 5,
        ]);
    }
}
