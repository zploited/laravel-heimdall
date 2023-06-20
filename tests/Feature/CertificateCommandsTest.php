<?php

namespace Zploited\Heimdall\Tests\Feature;

use Database\Factories\CertificateFactory;
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

    public function test_console_can_list_certificates(): void
    {
        CertificateFactory::new()->count(2)->create();

        $this->artisan('certificate:list')
            ->expectsTable(['id','public','created_at','revoked_at'], Certificate::all())
            ->assertOk();
    }
}