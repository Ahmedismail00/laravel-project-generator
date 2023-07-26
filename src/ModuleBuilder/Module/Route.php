<?php

namespace Isayama3\TheGenerator\ModuleBuilder\Module;

use Isayama3\TheGenerator\ModuleBuilder\Module\AbstarctComponent;

class Route extends AbstarctComponent
{
  public function __construct(array $data)
  {
    parent::__construct($data);
    $this->Build();
  }

  public function Build(): void
  {
    $route_name = lcfirst($this->getData()['name']);
    $request_type = $this->getData()['request_type'];
    $this->setDestinationPath($request_type);
    $this->setComponentData();
  }

  public function setDestinationPath(string $file_name): void
  {
    $this->destination_file_path = base_path() . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . $file_name . '.php';
  }

  public function setComponentData(): void
  {
    $route_name = lcfirst($this->getData()['name']);    
    $controller =  ucfirst($this->getData()['name']).'Controller::class';;    
    $data = "Route::resource('" . $route_name . "'," . $controller .");";

    // check if the route already exist
    if( strpos(file_get_contents($this->destination_file_path),$data) == false) {
      file_put_contents($this->destination_file_path , PHP_EOL.$data ,FILE_APPEND);
    }
  }
}
