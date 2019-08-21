<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class UserPermissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
