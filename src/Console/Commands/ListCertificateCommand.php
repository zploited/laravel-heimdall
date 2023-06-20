<?php

namespace Zploited\Heimdall\Console\Commands;

use Illuminate\Console\Command;
use Zploited\Heimdall\Models\Certificate;

class ListCertificateCommand extends Command
{
    protected $signature = "certificate:list";
    protected $description = "Shows a list of all created certificates.";

    public function handle(): int
    {
        $this->table(['id','public','created_at','revoked_at'], Certificate::all());

        return 0;
    }
}