<?php

use Isayama3\Isayama3\TheGenerator\ModulesGenerator;
require_once __DIR__ . '/vendor/autoload.php';

$the_generator = new ModulesGenerator("./src/admin.json");

dd($the_generator->readDataFile('./src/admin.json'));


function dd($v){
    var_dump($v);
    die();
}