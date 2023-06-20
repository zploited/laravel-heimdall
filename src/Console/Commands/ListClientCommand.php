<?php

namespace Zploited\Heimdall\Console\Commands;

use Illuminate\Console\Command;
use Zploited\Heimdall\Models\Client;

class ListClientCommand extends Command
{
    protected $signature = 'client:list';
    protected $description = 'Lists all registered clients in the database.';

    public function handle(): int
    {
        $this->table(
            ['id', 'name', 'allow_skip_consent', 'created_at', 'updated_at'],
            Client::select(
                ['id', 'name', 'allow_skip_consent', 'created_at', 'updated_at']
            )->get());

        return 0;
    }
}