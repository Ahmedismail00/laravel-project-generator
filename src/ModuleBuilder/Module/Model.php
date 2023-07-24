<?php

namespace TheGenerator\ModuleBuilder\Module;

use Illuminate\Support\Facades\Artisan;
use TheGenerator\ModuleBuilder\Module\AbstarctComponent;

class Model extends AbstarctComponent
{
  public function __construct(array $data)
  {
    parent::__construct($data);
    $this->Build();
  }

  public function Build(): void
  {
    $model_name = ucfirst($this->getData()['name']);
    Artisan::call('make:model ' . $model_name);
    $this->setDestinationPath($model_name);
    $this->setComponentData();
  }

  public function setDestinationPath(string $file_name): void
  {
    $this->destination_file_path = app_path() . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . $file_name . '.php';
  }
  
  public function setComponentData(): void
  {
    $this->setFillableAttributes($this->getData()['fields']);
    $this->setRelationships($this->getData()['relations']);
  }

  /**
   * write fillable attribute to our model.
   */
  public function setFillableAttributes($fields)
  {
    $fillable = [];

    foreach ($fields as $field) {
      if (is_array($field['validation'])) {
        if (array_key_exists("required", $field['validation']) || in_array("required",$field['validation'])) {
          array_push($fillable, $field['name']);
        }
      } else {
        array_push($fillable, $field['validation']);
      }
    }
    
    $replace = implode("','", $fillable);
    $subject = file_get_contents($this->destination_file_path);
    $data = str_replace('#FillableArray#', $replace , $subject);

    file_put_contents($this->destination_file_path, $data);

  }

  /**
   * Set Relations to out created model
   */
  public function setRelationships($relations)
  {
    $all_relations = [];

    foreach ($relations as $relation) {
      $function = "\tpublic function " . lcfirst($relation['relation_name']) . "()\n";
      $function .= "\t{\n\t\treturn \$this->" . lcfirst($relation['relation_type']) . "('" . ucfirst($relation['relation_model']) . "');\n";
      $function .= "\t}\n";
      array_push($all_relations, $function);
    }

    $replace = implode("\n", $all_relations);
    $subject = file_get_contents($this->destination_file_path);
    $data = str_replace('#Relationships#', $replace , $subject);

    file_put_contents($this->destination_file_path, $data);
  }

}
