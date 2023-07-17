<?php

namespace TheGenerator\ModuleBuilder\Module;

abstract class AbstarctComponent
{
    /**
     * Data that we get from our module file.
     */
    private $data;
    protected $destination_file_path;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->Build();
    }
    
    /**
     * Get the module file data
     */
    protected function getData(){
        return $this->data;
    }

    /**
     * Set path for the file that we working on.
     */
    abstract function setDestinationPath(string $file_name): void;
    
    /**
   * write data to our module componant.
   */
    abstract public function setComponentData(): void;

    /**
     * Launch required actions to build specific componant or add module related data to specific file like route.
     */
    abstract public function Build(): void;

}