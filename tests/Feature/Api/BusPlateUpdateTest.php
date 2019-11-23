<?php

namespace Tests\Feature\Api;

use App\Bus;
use App\Http\Resources\SuccessJSONResponseResource;
use App\User;
use Tests\ApiTestCase;

class BusPlateUpdateTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/buses/';
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
    public function update_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Bus $model */
        $model = factory(Bus::class)->create();

        /** @var Bus $modelData */
        $modelData = factory(Bus::class)->make();

        $this->postJson($this->url() . $model->id . '/updatePlate', $modelData->toArray())
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('buses', [
            'id'             => $model->id,
            'active_plate'   => $modelData->active_plate,
            'official_plate' => $modelData->official_plate,
            'code'           => $modelData->code,
        ]);
    }


}
