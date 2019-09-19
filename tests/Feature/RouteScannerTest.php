<?php

namespace Tests\Feature;

use App\Http\Resources\Api\RouteScannerResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\RouteScanner;
use App\User;
use Tests\ApiTestCase;

class RouteScannerTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/routeScanners/';
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
    public function it_requires_permission()
    {
        $this->actingAs(factory(User::class)->create(), 'api')
            ->getJson($this->url())
            ->assertForbidden();
    }

    /** @test */
    public function index_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var RouteScanner $model */
        $model = factory(RouteScanner::class)->create();

        $this->getJson($this->url())
            ->assertSuccessful()
            ->assertJsonFragment((new RouteScannerResource($model))->jsonSerialize());
    }

    /** @test */
    public function show_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var RouteScanner $model */
        $model = factory(RouteScanner::class)->create();

        $this->getJson($this->url() . $model->id)
            ->assertSuccessful()
            ->assertJsonFragment((new RouteScannerResource($model))->jsonSerialize());
    }

    /** @test */
    public function store_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var RouteScanner $model */
        $model = factory(RouteScanner::class)->make();

        $this->postJson($this->url(), $model->toArray())
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('route_scanners', [
            'code'     => $model->code,
            'status'   => $model->status,
            'settings' => $model->settings,
        ]);
    }

    /** @test */
    public function update_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var RouteScanner $model */
        $model = factory(RouteScanner::class)->create();

        /** @var RouteScanner $modelData */
        $modelData = factory(RouteScanner::class)->make();

        $this->putJson($this->url() . $model->id, $modelData->toArray())
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('route_scanners', [
            'id'       => $model->id,
            'code'     => $modelData->code,
            'status'   => $modelData->status,
            'settings' => $modelData->settings,
        ]);
    }

    /** @test */
    public function delete_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var RouteScanner $model */
        $model = factory(RouteScanner::class)->create();

        $this->deleteJson($this->url() . $model->id)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseMissing('services', [
           'id' => $model->id,
        ]);
    }
}
