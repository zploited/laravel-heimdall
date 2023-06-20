<?php

namespace Zploited\Heimdall\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Zploited\Heimdall\Models\Client;

class CreateClientCommand extends Command
{
    protected $signature = 'client:create 
                                {name : Display name of the new client.}
                                {--redirect-uri= : Adds a given redirect uri to the client.}';
    protected $description = 'Creates a new client and stores it in the database.';

    public function handle(): int
    {
        Client::create([
            'name' => $this->argument('name'),
            'redirect_uri' => $this->option('redirect-uri') ? [$this->option('redirect-uri')] : null
        ]);

        return 0;
    }
}