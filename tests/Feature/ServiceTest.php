<?php

namespace Tests\Feature;

use App\Enums\ServiceStatus;
use App\Http\Resources\Api\ServiceResource;
use App\Http\Resources\Api\ServiceSettingsResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Service;
use App\User;
use Tests\ApiTestCase;

class ServiceTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/services/';
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

        /** @var Service $model */
        $model = factory(Service::class)->create();

        $this->getJson($this->url())
            ->assertSuccessful()
            ->assertJsonFragment((new ServiceResource($model))->jsonSerialize());
    }

    /** @test */
    public function show_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Service $model */
        $model = factory(Service::class)->create();

        $this->getJson($this->url() . $model->id)
            ->assertSuccessful()
            ->assertJsonFragment((new ServiceResource($model))->jsonSerialize());
    }

    /** @test */
    public function store_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Service $model */
        $model = factory(Service::class)->make();

        $this->postJson($this->url(), $model->toArray())->dump()
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('services', [
            'name'     => $model->name,
            'type'     => $model->type,
            'status'   => $model->status,
            'interval' => $model->interval,
        ]);
    }

    /** @test */
    public function update_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Service $model */
        $model = factory(Service::class)->create();

        /** @var Service $modelData */
        $modelData = factory(Service::class)->make();

        $this->putJson($this->url() . $model->id, $modelData->toArray())
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('services', [
            'id'       => $model->id,
            'name'     => $modelData->name,
            'type'     => $modelData->type,
            'status'   => $modelData->status,
            'interval' => $modelData->interval,
        ]);
    }

    /** @test */
    public function delete_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Service $model */
        $model = factory(Service::class)->create();

        $this->deleteJson($this->url() . $model->id)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseMissing('services', [
           'id' => $model->id,
        ]);
    }

    /** @test */
    public function get_settings_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Service $model */
        $model = factory(Service::class)->create();

        $this->getJson($this->url() . $model->id . '/settings')
            ->assertSuccessful()
            ->assertJsonFragment((new ServiceSettingsResource($model))->jsonSerialize());
    }

    /** @test */
    public function set_settings_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Service $model */
        $model = factory(Service::class)->create();

        $attributes = [
            'interval' => 1000,
            'status'   => ServiceStatus::STOPPED,
        ];

        $this->putJson($this->url() . $model->id . '/settings', $attributes)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('services', [
            'id'       => $model->id,
            'interval' => $attributes['interval'],
            'status'   => $attributes['status'],
        ]);
    }
}
