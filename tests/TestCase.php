<?php

namespace Tests;

use App\Eloquent\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getHeader($header = [])
    {
        $default = [
            'Accept' => 'application/json',
        ];
        $headers = count($header) ? array_merge($default, $header) : $default;

        return $this->transformHeadersToServerVars($headers);
    }

    public function createUser()
    {
        return factory(User::class)->create();
    }
}
