<?php
namespace Isayama3\TheGenerator\ModuleBuilder;

use Isayama3\TheGenerator\ModuleBuilder\Module\Model;
use Isayama3\TheGenerator\ModuleBuilder\Module\Route;
use Isayama3\TheGenerator\ModuleBuilder\Module\Types\Module;

abstract class Builder
{
    protected array $module_data;
    
    /**
     * Write content into our file.
     */
    public function writeFiles(string $target,string $file_path,string $content) : void 
    {
        file_put_contents(
            $file_path,
            str_replace($target, $content, file_get_contents($file_path))
        );  
    }

    // abstract protected function buildController(): Controller;
    abstract public function getModule(): Module ;
}