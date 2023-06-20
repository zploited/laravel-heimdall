<?php

namespace Zploited\Heimdall\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Zploited\Heimdall\Models\Certificate;

class RevokeCertificateCommand extends Command
{
    protected $signature = "certificate:revoke {id : id of the certificate to be revoked.}";
    protected $description = "Revoke a specific certificate, identified by its id. This will render the specified certificate invalid.";

    public function handle(): int
    {
        $certificate = Certificate::find($this->argument('id'));

        if($certificate) {
            $certificate->revoked_at = Carbon::now();
            $certificate->save();

            $this->info('The certificate have been revoked, and can no longer be used.');

            return 0;
        } else {
            $this->warn('There is no certificate with the provided id. Nothing has been done.');

            return 1;
        }
    }
}