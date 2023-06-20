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

        if($client) {
            $client->delete();
            $this->info('The client have been deleted.');

            return 0;
        } else {
            $this->alert('There is no client with the provided id.');

            return 1;
        }
    }
}