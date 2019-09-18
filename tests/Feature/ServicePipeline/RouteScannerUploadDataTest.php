<?php

namespace Tests\Feature;

use App\Http\Resources\SuccessJSONResponseResource;
use App\Route;
use App\Service;
use Tests\ApiTestCase;

class RouteScannerUploadDataTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/servicePipeline/routeScanner/uploadRouteScannerData/';
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
    public function it_uploads_data() // @todo check if file is created or not!!
    {
        /** @var Service $service */
        $service = factory(Service::class)->create();

        $this->actingAs($service, 'service');

        /** @var Route $route */
        $route = factory(Route::class)->create();

        $this->getJson($this->url() . $route->code)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());
    }
}
