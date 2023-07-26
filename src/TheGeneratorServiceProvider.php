<?php
namespace Isayama3\TheGenerator;

use App\Console\Commands\InitGenerator;
use App\Console\Commands\LaunchGenerator;
use App\Console\Commands\MakeGeneratorController;
use Illuminate\Support\ServiceProvider;

class TheGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InitGenerator::class,
                LaunchGenerator::class,
                MakeGeneratorController::class,
                MakeGeneratorMigration::class,
                MakeGeneratorModel::class,
                MakeGeneratorRequest::class,
            ]);
        }
    }
}