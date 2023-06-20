<?php

namespace Zploited\Heimdall\Console\Commands;

use Illuminate\Console\Command;
use Zploited\Heimdall\Models\Certificate;

class CreateCertificateCommand extends Command
{
    protected $signature = "certificate:create";
    protected $description = "Creates a new certificate pair (public and private) and stores it in the database.";

    public function handle(): int
    {
        if(Certificate::create()) {
            $this->info('Certificate was created successfully.');
            return 0;
        } else {
            $this->warn('Certificate could not be created.');
            return 1;
        }
    }
}