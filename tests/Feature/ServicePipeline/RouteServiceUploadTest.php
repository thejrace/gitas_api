<?php

namespace Tests\Feature\ServicePipeline;

use App\Enums\RouteDirection;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Service;
use Tests\ApiTestCase;

class RouteServiceUploadTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/servicePipeline/updateRoutes/';
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
    public function it_updates_route()
    {
        /** @var Service $service */
        $service = factory(Service::class)->create();

        $this->actingAs($service, 'service');

        $routeData = [
            'code'  => '15BK',
            'name'  => 'Kadıköy - Beykoz',
            'stops' => [
                [
                    'no'        => 1,
                    'name'      => 'AKBABA',
                    'direction' => RouteDirection::FORWARD,
                ],
                [
                    'no'        => 2,
                    'name'      => 'DERESEKİ',
                    'direction' => RouteDirection::FORWARD,
                ],
            ],
        ];

        $this->putJson($this->url(), ['data' => json_encode($routeData)])
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('routes', [
            'code' => '15BK',
            'name' => 'Kadıköy - Beykoz',
        ]);

        $this->assertDatabaseHas('route_stops', [
            //'route_id' => 1,
            'name'      => 'AKBABA',
            'no'        => 1,
            'direction' => RouteDirection::FORWARD,
        ]);
    }
}
