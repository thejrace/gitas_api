<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class ApiTestCase extends TestCase
{
    use DatabaseTransactions;

    /**
     * Get base Url for the API endpoint
     *
     * @return string
     */
    protected function url(): string
    {
        return '/';
    }
}
