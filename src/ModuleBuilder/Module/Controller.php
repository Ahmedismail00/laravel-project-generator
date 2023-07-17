<?php

namespace TheGenerator\ModuleBuilder\Module;

use Illuminate\Support\Facades\Artisan;
use TheGenerator\ModuleBuilder;
use TheGenerator\ModuleBuilder\Module\AbstarctComponent;

class Controller extends AbstarctComponent
{
    public function __construct(array $data)
  {
    parent::__construct($data);
    $this->Build();
  }

  public function Build(): void
  {
    $controller_name = ucfirst($this->getData()['name']);
    // TODO : make custom controller for crud operations.
    if($this->getData()['request_type'] == 'api'){
      Artisan::call('make:controller --type=generator Api/' . $controller_name.'Controller --api --resource --model='.$controller_name);
    }elseif($this->getData()['request_type'] == 'web'){
      Artisan::call('make:controller --type=generator Web/' . $controller_name.'Controller --resource --model='.$controller_name);
    }
    
    $this->setDestinationPath($controller_name);
  }

  public function setDestinationPath(string $file_name): void
  { 
    if($this->getData()['request_type'] == 'api'){
      $this->destination_file_path = app_path() . DIRECTORY_SEPARATOR . 'Http/Controllers/Api' . DIRECTORY_SEPARATOR . $file_name . 'Controller.php';
    }elseif($this->getData()['request_type'] == 'web'){
      $this->destination_file_path = app_path() . DIRECTORY_SEPARATOR . 'Http/Controllers/Web' . DIRECTORY_SEPARATOR . $file_name . 'Controller.php';
    }
  }
  
  public function setComponentData(): void
  {
    // TODO : What will we set here ?
  }  
}