<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * @param string $method
     * @param string $uri
     * @param array  $data
     * @param array  $headers
     * @return TestResponse
     */
    public function json ($method, $uri, array $data = [], array $headers = []): TestResponse
    {
        $uri = "/api/{$uri}";
        return parent::json($method, $uri, $data, $headers);
    }
}
