<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TheGenerator\ModuleBuilder\Builders\ModuleBuilder;
use TheGenerator\ModuleBuilder\Director;

class LaunchGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'launch:generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modules_data = $this->loadModulesData(base_path(). DIRECTORY_SEPARATOR .'data');

        $director = new Director();

        foreach($modules_data as $module_data)
        {                
            $director->setBuilder(new ModuleBuilder($module_data));
            $director->makeModule();
        }        
    }

    /**
     * Load modules files
     */
    protected function loadModulesData($modules_path) : array
    {
        $modules_files_names = array_diff(scandir($modules_path), array('.', '..'));
        $modules_data = [];
        foreach($modules_files_names as $file){
            $data = include $modules_path . '/' . $file;
            array_push($modules_data , $data); 
        }
        return $modules_data;
    }
}
