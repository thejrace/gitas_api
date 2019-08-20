<?php

namespace Tests\Feature\Api;

use App\AppModuleUser;
use App\Http\Resources\AppModuleUserResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\User;
use Tests\ApiTestCase;

class AppModuleUserTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/app_module_users/';
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
    public function it_requires_permission()
    {
        $this->actingAs(factory(User::class)->create(), 'api')
            ->getJson($this->url() . '1')
            ->assertForbidden();
    }

    /** @test */
    public function index_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var AppModuleUser $model */
        $model = factory(AppModuleUser::class)->create();

        $this->getJson($this->url() . $model->app_module_id)
            ->assertSuccessful()
            ->assertJsonFragment((new AppModuleUserResource($model))->jsonSerialize());
    }

    /** @test */
    public function show_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var AppModuleUser $model */
        $model = factory(AppModuleUser::class)->create();

        $this->getJson($this->url() . $model->app_module_id . '/' . $model->id)
            ->assertSuccessful()
            ->assertJsonFragment((new AppModuleUserResource($model))->jsonSerialize());
    }

    /** @test */
    public function store_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var AppModuleUser $model */
        $model = factory(AppModuleUser::class)->make();

        $attributes = $model->toArray();
        $attributes['password'] = 'xxx';

        $this->postJson($this->url(), $attributes)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('app_module_users', [
            'name' => $model->name,
            'email' => $model->email,
            'app_module_id' => $model->app_module_id,
        ]);
    }

    /** @test */
    public function update_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var AppModuleUser $model */
        $model = factory(AppModuleUser::class)->create();

        /** @var AppModuleUser $modelData */
        $modelData = factory(AppModuleUser::class)->make();

        $this->putJson($this->url() . $model->id, $modelData->toArray())
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('app_module_users', [
            'id' => $model->id,
            'name' => $modelData->name,
            'app_module_id' => $modelData->app_module_id,
            'email' => $modelData->email,
        ]);
    }

    /** @test */
    public function delete_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var AppModuleUser $model */
        $model = factory(AppModuleUser::class)->create();

        $this->delete($this->url() . $model->id )
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseMissing('app_module_users', [
            'id' => $model->id,
        ]);
    }
}
