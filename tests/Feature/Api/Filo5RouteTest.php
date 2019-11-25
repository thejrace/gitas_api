<?php

namespace Tests\Feature\Api;

use App\User;
use Tests\ApiTestCase;

class Filo5RouteTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/routes/filo5';
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


        $this->getJson($this->url())
            ->assertSuccessful();
    }
}
