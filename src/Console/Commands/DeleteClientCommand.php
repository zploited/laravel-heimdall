<?php

namespace Zploited\Heimdall\Console\Commands;

use Illuminate\Console\Command;
use Zploited\Heimdall\Models\Client;

class DeleteClientCommand extends Command
{
    protected $signature = 'client:delete { id : Identifier of the client that needs to be deleted. }';
    protected $description = 'Deletes a client with a given id.';

    public function handle(): int
    {
        $client = Client::find($this->argument('id'));
        $client->delete();
        $this->info('Client is deleted.');

        return 0;
    }
}