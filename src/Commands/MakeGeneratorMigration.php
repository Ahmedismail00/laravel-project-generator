<?php

namespace Isayama3\TheGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Filesystem\Filesystem;

class MakeGeneratorMigration extends Command
{

    protected $signature = 'generator:migration {name : The name of the migration}
                            {--create= : The table to be created}
                            {--table= : The table to migrate}
                            {--path= : The location where the migration file should be created}
                            {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
                            {--fullpath : Output the full path of the migration (Deprecated)}';

    protected $description = 'create a new custom migration class for the generator';

    public function handle()
    {
        $customStubPath =  __DIR__ . '/../'.'../Helpers/Base/stubs'; // You can get this from a configuration or elsewhere.
        // Resolve the Filesystem instance from the service container
        $filesystem = app(Filesystem::class);

        // Create the MigrationCreator instance with the correct Filesystem dependency
        $migrationCreator = new MigrationCreator($filesystem, $customStubPath);

        $name = $this->argument('name');
        $table = $this->option('table');
        $create = $this->option('create');
        $path = database_path('migrations');

        // Generate the migration file using the MigrationCreator instance
        $path = $migrationCreator->create($name, $path, $table, $create);

        // Display the path of the created migration file
        $this->info("Migration created successfully: $path");
    }

}
