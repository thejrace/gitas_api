<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Get a user for the tests
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|User
     */
    protected function getUser()
    {
        return User::first();
    }
}
