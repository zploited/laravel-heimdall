<?php

namespace Zploited\Heimdall\Console\Commands;

use Illuminate\Console\Command;
use Zploited\Heimdall\Models\Client;

class CreateClientCommand extends Command
{
    protected $signature = 'client:create 
                                {name : Display name of the new client.}';
    protected $description = 'Creates a new client and stores it in the database.';

    public function handle(): int
    {
        Client::create([
            'name' => $this->argument('name')
        ]);

        return 0;
    }
}