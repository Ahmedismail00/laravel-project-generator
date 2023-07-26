<?php

namespace Isayama3\TheGenerator\Commands;

use Illuminate\Console\Command;

class InitGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the generator package by adding the data folder and the example file to the project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!file_exists(base_path('data'))) {
            mkdir(base_path('data'), 0777, true);
        }
        // Todo:: change the first path of the copy function to the path of the file in the package
        copy(app_path('Helpers/Base/data/example.php'), base_path('data/example.php'));

    }
}
