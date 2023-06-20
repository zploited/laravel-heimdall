<?php
namespace Zploited\Heimdall\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Zploited\Heimdall\Models\Client;
use Zploited\Heimdall\Tests\TestCase;

class ClientCommandsTest extends TestCase
{
    use RefreshDatabase;

    public function test_console_can_create_client(): void
    {
        $this->artisan('client:create test-client')
            ->assertOk();

        $this->assertDatabaseCount(Client::class, 1);
    }
}