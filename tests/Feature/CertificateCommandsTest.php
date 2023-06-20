<?php

namespace Zploited\Heimdall\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Zploited\Heimdall\Models\Certificate;
use Zploited\Heimdall\Tests\TestCase;

class CertificateCommandsTest extends TestCase
{
    use RefreshDatabase;

    public function test_console_can_create_certificate(): void
    {
        $this->artisan('certificate:create')
            ->assertOk();

        $this->assertDatabaseCount(Certificate::class, 1);
    }
}