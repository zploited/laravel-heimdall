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

    public function test_console_can_revoke_certificate(): void
    {
        $certificate = CertificateFactory::new()->create();

        $this->artisan('certificate:revoke '. $certificate->id)
            ->expectsOutput('The certificate have been revoked, and can no longer be used.')
            ->assertOk();

        $this->assertNotNull(Certificate::first()->revoked_at);
    }

    public function test_console_fails_revokation_on_wrong_id(): void
    {
        $this->artisan('certificate:revoke 0')
            ->expectsOutput('There is no certificate with the provided id. Nothing has been done.')
            ->assertFailed();
    }
}