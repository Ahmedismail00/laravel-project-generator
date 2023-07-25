<?php

namespace TheGenerator\ModuleBuilder\Module;

use Illuminate\Support\Facades\Artisan;
use TheGenerator\ModuleBuilder\Module\AbstarctComponent;

class Migration extends AbstarctComponent
{
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->Build();
    }

    public function Build(): void
    {
        $migration_name = ucfirst($this->getData()['name']);
        $destination_file_name = 'create_' . lcfirst($migration_name) . 's_table.php';
        $migration_files = array_diff(scandir(database_path() . '/migrations' . "/"), array('.', '..'));
        $file_exist = false;
        foreach ($migration_files as $file) {
            if (str_contains($file, $destination_file_name)) {
                $file_exist = true;
            }
        }

        if(!$file_exist){
            Artisan::call('generator:migration create_' . lcfirst($migration_name) . 's_table --create='.lcfirst($migration_name).' --table='.lcfirst($migration_name).'s');
            $this->setDestinationPath($destination_file_name);
            $this->setComponentData();
        }
    }

    public function setDestinationPath(string $file_name): void
    {
        $files = scandir(database_path() . '/migrations' . "/");
        $migration_files = array_diff($files, array('.', '..'));
        foreach ($migration_files as $file) {
            if (str_contains($file, $file_name)) {
                $file_name = $file;
            }
        }
        $this->destination_file_path = database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . $file_name ;
    }

    public function setComponentData(): void
    {
        $this->setMigrationsFields();
    }

    /**
     * write migration fields to our migration file.
     */
    public function setMigrationsFields()
    {
        $module_fields = $this->getData()['fields'];
        $migration_fields = [];
        foreach ($module_fields as $field) {
            if(isset($field['options'])){
                if(is_array($field['options'])){
                    $migration_field = "$"."table->".$field['type']."('".$field['name']."')";
                    foreach($field['options'] as $key => $value){
                        if(is_integer($key) && !is_bool($value)){
                            $migration_field .= "->".$value."()";
                        }
                        else{
                            if(!is_bool($value)){
                                $migration_field .= "->".$key."('".$value."')";
                            }else{
                                $migration_field .= "->".$key."()";
                            }
                        }
                        array_push($migration_fields, $migration_field);
                    }
                }
            }else{
                $migration_field = "$"."table->".$field['type']."('".$field['name']."')";
                array_push($migration_fields, $migration_field);
            }
        }
        $replace = '';
        foreach ($migration_fields as $field) {
            $replace .= "\t\t\t $field;\n";
        }
    
        $subject = file_get_contents($this->destination_file_path);
        $data = str_replace('#FIELDS#', $replace, $subject);

        file_put_contents($this->destination_file_path, $data);
    }

    
}
