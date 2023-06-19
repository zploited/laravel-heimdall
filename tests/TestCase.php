<?php

namespace Zploited\Heimdall\Tests;

use Zploited\Heimdall\HeimdallServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            HeimdallServiceProvider::class
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [];
    }
}