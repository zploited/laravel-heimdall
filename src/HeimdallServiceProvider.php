<?php

namespace Zploited\Heimdall;

use Illuminate\Support\ServiceProvider;
use Zploited\Heimdall\Console\Commands\CreateCertificateCommand;
use Zploited\Heimdall\Console\Commands\CreateClientCommand;
use Zploited\Heimdall\Console\Commands\DeleteClientCommand;
use Zploited\Heimdall\Console\Commands\ListCertificateCommand;
use Zploited\Heimdall\Console\Commands\ListClientCommand;
use Zploited\Heimdall\Console\Commands\RevokeCertificateCommand;
use Zploited\Heimdall\Console\Commands\SecretClientCommand;

class HeimdallServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadCommands();
    }

    /**
     * Loads available commands for this provider.
     * @return void
     */
    private function loadCommands()
    {
        if($this->app->runningInConsole()) {
            $this->commands([
                CreateCertificateCommand::class,
                ListCertificateCommand::class,
                RevokeCertificateCommand::class,

                CreateClientCommand::class,
                DeleteClientCommand::class,
                ListClientCommand::class,
                SecretClientCommand::class
            ]);
        }
    }
}