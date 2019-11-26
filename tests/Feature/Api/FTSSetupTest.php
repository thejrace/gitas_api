<?php

namespace Tests\Feature\Api;

use Tests\ApiTestCase;

class FTSSetupTest extends ApiTestCase
{
    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/api/fts/setup';
    }

    /** @test */
    public function applicationDataTest()
    {
        $this->actingAs($this->getUser(), 'api');

        $this->getJson($this->url())
            ->assertSuccessful()->dump();
    }
}
