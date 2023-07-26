<?php

namespace Isayama3\TheGenerator\ModuleBuilder\Module;

use Illuminate\Support\Facades\Artisan;
use Isayama3\TheGenerator\ModuleBuilder\Module\AbstarctComponent;

class Request extends AbstarctComponent
{
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->Build();
    }

    public function Build(): void
    {
        $request_name = ucfirst($this->getData()['name']);
        if ($this->getData()['request_type'] == 'api') {
            Artisan::call('generator:request Api/' . $request_name.'Request');
        } elseif ($this->getData()['request_type'] == 'web') {
            Artisan::call('generator:request Web/' . $request_name.'Request');
        }
        $this->setDestinationPath($request_name);
        $this->setComponentData();
    }

    public function setDestinationPath(string $file_name): void
    {
        if ($this->getData()['request_type'] == 'api') {
            $this->destination_file_path = app_path() . DIRECTORY_SEPARATOR . 'Http/Requests/Api' . DIRECTORY_SEPARATOR . $file_name . 'Request.php';
        } elseif ($this->getData()['request_type'] == 'web') {
            $this->destination_file_path = app_path() . DIRECTORY_SEPARATOR . 'Http/Requests/Web' . DIRECTORY_SEPARATOR . $file_name . 'Request.php';
        }
    }

    public function setComponentData(): void
    {
        $this->setPostRules();
        // Todo:: PUTRULES
        $this->setPutRules();
    }

    /**
     * write fillable attribute to our model.
     */
    public function setPostRules()
    {
        $fields = $this->getData()['fields'];
        $validations = [];
        $rules = [];

        foreach ($fields as $field) {
            if (is_array($field['validation'])) {
                $validations[$field['name']] = $field['validation'];
            } else {
                $validations[$field['name']] = $field['validation'];
            }
        }

        foreach($validations as $key=>$value){
            $values = null;
            if(is_array($value)){
                $values = implode("|", $value);
            }else{
                $values = $value;
            }
            $replace = "\t\t\t\t\t\t'$key' => '$values',";
            array_push($rules, $replace);
        }

        $replace = implode(PHP_EOL, $rules);
        $subject = file_get_contents($this->destination_file_path);

        $data = str_replace('#POSTRULES#', $replace, $subject);
        file_put_contents($this->destination_file_path, $data);
    }

    /**
     * Set Relations to out created model
     */
    public function setPutRules()
    {
        $fields = $this->getData()['fields'];
        $validations = [];
        $rules = [];

        foreach ($fields as $field) {
            if (is_array($field['validation'])) {
                $validations[$field['name']] = $field['validation'];
            } else {
                $validations[$field['name']] = $field['validation'];
            }
        }

        foreach($validations as $key=>$value){
            $values = null;
            if(is_array($value)){
                $values = implode("|", $value);
            }else{
                $values = $value;
            }
            $replace = "\t\t\t\t\t\t'$key' => '$values',";
            array_push($rules, $replace);
        }

        $replace = implode(PHP_EOL, $rules);
        $subject = file_get_contents($this->destination_file_path);

        $data = str_replace('#PUTRULES#', $replace, $subject);
        file_put_contents($this->destination_file_path, $data);
    }
}
