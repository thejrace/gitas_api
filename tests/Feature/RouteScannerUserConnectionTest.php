<?php

namespace Tests\Feature;

use App\Http\Resources\SuccessJSONResponseResource;
use App\RouteScanner;
use App\RouteScannerUserConnections;
use App\User;
use Tests\ApiTestCase;

class RouteScannerUserConnectionTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/routeScannerUserConnection/';
    }

    /** @test */
    public function it_requires_authentication()
    {
        $this->postJson($this->url() . '1/1')
            ->assertStatus(401)
            ->assertExactJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    /** @test */
    public function it_requires_permission()
    {
        $this->actingAs(factory(User::class)->create(), 'api')
            ->postJson($this->url() . '1/1')
            ->assertForbidden();
    }

    /** @test */
    public function store_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var RouteScanner $routeScanner */
        $routeScanner = factory(RouteScanner::class)->create();

        $userId = 15;

        $this->postJson($this->url() . $userId . '/' . $routeScanner->id)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('route_scanner_user_connections', [
            'user_id'          => $userId,
            'route_scanner_id' => $routeScanner->id,
        ]);
    }

    /** @test */
    public function delete_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var RouteScannerUserConnections $model */
        $model = factory(RouteScannerUserConnections::class)->create();

        $this->deleteJson($this->url() . $model->user_id . '/' . $model->route_scanner_id)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseMissing('route_scanner_user_connections', [
            'user_id'          => $model->user_id,
            'route_scanner_id' => $model->route_scanner_id,
        ]);
    }
}
