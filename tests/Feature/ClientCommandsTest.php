<?php
namespace Zploited\Heimdall\Tests\Feature;

use Database\Factories\ClientFactory;
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

    public function test_console_can_add_redirect_uri_while_creating_client(): void
    {
        $this->artisan('client:create test-client --redirect-uri=https://mydomain.tld')
            ->assertOk();

        $this->assertDatabaseCount(Client::class, 1);
        $this->assertEquals('https://mydomain.tld', Client::first()->redirect_uri->first());
    }

    public function test_console_can_add_secret_while_creating_client(): void
    {
        $this->artisan('client:create test-client --with-secret')
            ->assertOk();

        $this->assertDatabaseCount(Client::class, 1);
        $this->assertNotNull(Client::first()->secret);
    }

    public function test_console_can_delete_client(): void
    {
        $client = ClientFactory::new()->create();

        $this->artisan('client:delete ' . $client->id)
            ->assertOk();

        $this->assertDatabaseCount(Client::class, 0);
    }

    public function test_console_fails_while_delete_client_with_wrong_id(): void
    {
        $this->artisan('client:delete 0')
            ->assertFailed();
    }

    public function test_console_can_list_clients(): void
    {
        ClientFactory::new()->count(2)->create();

        $this->artisan('client:list')
            ->expectsTable(['id', 'name', 'allow_skip_consent', 'created_at', 'updated_at'], Client::select(['id', 'name', 'allow_skip_consent', 'created_at', 'updated_at'])->get())
            ->assertOk();
    }
}