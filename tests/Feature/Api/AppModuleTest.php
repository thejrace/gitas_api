<?php

namespace Tests\Feature\Api;

use App\AppModule;
use App\Http\Resources\AppModuleResource;
use App\User;
use Tests\ApiTestCase;

class AppModuleTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/app_modules/';
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

        /** @var AppModule $model */
        $model = factory(AppModule::class)->create();

        $this->getJson($this->url())
            ->assertSuccessful()
            ->assertJsonFragment((new AppModuleResource($model))->jsonSerialize());
    }

    /** @test */
    public function show_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var AppModule $model */
        $model = factory(AppModule::class)->create();

        $this->getJson($this->url() . $model->id)
            ->assertSuccessful()
            ->assertJsonFragment((new AppModuleResource($model))->jsonSerialize());
    }
}
