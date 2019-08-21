<?php

namespace Tests\Feature\Api;

use App\AppModuleUser;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\User;
use Spatie\Permission\Models\Permission;
use Tests\ApiTestCase;

class AppModuleUserPermissionTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/app_module_user_permissions/';
    }

    /** @test */
    public function it_requires_authentication()
    {
        $this->getJson($this->url() . '1/1')
            ->assertStatus(401)
            ->assertExactJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    /** @test */
    public function it_requires_permission()
    {
        $this->actingAs(factory(User::class)->create(), 'api')
            ->getJson($this->url() . '1')->dump()
            ->assertForbidden();
    }

    /** @test */
    public function give_permission_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Permission $permission */
        $permission = factory(Permission::class)->create([
            'type'       => 1, // app module user type
            'guard_name' => 'app_module_user',
        ]);

        /** @var AppModuleUser $moduleUser */
        $moduleUser = factory(AppModuleUser::class)->create();

        $this->postJson($this->url() . $moduleUser->id . '/' . $permission->id)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseHas('model_has_permissions', [
            'permission_id' => $permission->id,
            'model_id'      => $moduleUser->id,
        ]);
    }

    /** @test */
    public function revoke_permission_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Permission $permission */
        $permission = factory(Permission::class)->create([
            'type'       => 1, // app module user type
            'guard_name' => 'app_module_user',
        ]);

        /** @var AppModuleUser $moduleUser */
        $moduleUser = factory(AppModuleUser::class)->create();

        $this->deleteJson($this->url() . $moduleUser->id . '/' . $permission->id)
            ->assertSuccessful()
            ->assertJsonFragment((new SuccessJSONResponseResource(null))->jsonSerialize());

        $this->assertDatabaseMissing('model_has_permissions', [
            'permission_id' => $permission->id,
            'model_id'      => $moduleUser->id,
        ]);
    }

    /** @test */
    public function has_permission_test()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Permission $permission */
        $permission = factory(Permission::class)->create([
            'type'       => 1, // app module user type
            'guard_name' => 'app_module_user',
        ]);

        /** @var AppModuleUser $moduleUser */
        $moduleUser = factory(AppModuleUser::class)->create();

        $moduleUser->givePermissionTo($permission);

        $this->getJson($this->url() . $moduleUser->id . '/' . $permission->id)
            ->assertSuccessful()
            ->assertJsonFragment([
                'hasPermission' => true,
            ]);
    }

    /** @test */
    public function get_permissions()
    {
        $this->actingAs($this->getUser(), 'api');

        /** @var Permission $permission */
        $permission = factory(Permission::class)->create([
            'type'       => 1, // app module user type
            'guard_name' => 'app_module_user',
        ]);

        /** @var AppModuleUser $moduleUser */
        $moduleUser = factory(AppModuleUser::class)->create();

        $moduleUser->givePermissionTo($permission);

        $this->getJson($this->url() . $moduleUser->id)
            ->assertSuccessful()
            ->assertJsonFragment((PermissionResource::collection($moduleUser->permissions))->jsonSerialize());
    }
}
