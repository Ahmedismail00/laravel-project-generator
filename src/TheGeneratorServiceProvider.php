<?php
namespace Isayama3\TheGenerator;

use Isayama3\TheGenerator\Commands\InitGenerator;
use Isayama3\TheGenerator\Commands\LaunchGenerator;
use Isayama3\TheGenerator\Commands\MakeGeneratorController;
use Illuminate\Support\ServiceProvider;

class TheGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     */
    public function registe(): void
    {
        $this->app->register(Isayama3\TheGenerator\TheGeneratorServiceProvider::class);

    }
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