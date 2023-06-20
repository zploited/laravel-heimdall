<?php

namespace Zploited\Heimdall\Console\Commands;

use Illuminate\Console\Command;
use Zploited\Heimdall\Models\Client;

class SecretClientCommand extends Command
{
    protected $signature = 'client:secret { id : Client identifier. }';
    protected $description = 'Show the secret for this client.';

    public function handle(): int
    {
        $client = Client::find($this->argument('id'));

        $this->info('Secret: '. $client->secret);
        return 0;
    }
}