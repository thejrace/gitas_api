<?php

namespace Tests\Feature\Api;

use App\AppModule;
use App\AppModuleUser;
use App\Http\Resources\AppModuleResource;
use App\Http\Resources\SuccessJSONResponseResource;
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

    /** @test */
    public function store_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var AppModule $model */
        $model = factory(AppModule::class)->make();

        $this->postJson($this->url(), $model->toArray())
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());
    }

    /** @test */
    public function update_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var AppModule $model */
        $model = factory(AppModule::class)->create();

        /** @var AppModule $modelData */
        $modelData = factory(AppModule::class)->make();

        $this->putJson($this->url() . $model->id, $modelData->toArray())
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('app_modules', [
            'id'                => $model->id,
            'name'              => $modelData->name,
            'description'       => $modelData->description,
            'permission_prefix' => $modelData->permission_prefix,
        ]);
    }

    /** @test */
    public function delete_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var AppModule $model */
        $model = factory(AppModule::class)->create();

        $moduleUser = factory(AppModuleUser::class)->create([
            'app_module_id' => $model->id,
        ]);

        $this->delete($this->url() . $model->id)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseMissing('app_modules', [
            'id' => $model->id,
        ]);

        $this->assertDatabaseMissing('app_module_users', [
            'id' => $moduleUser->id,
        ]);
    }
}
