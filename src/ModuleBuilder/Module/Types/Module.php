<?php

namespace TheGenerator\ModuleBuilder\Module\Types;

use TheGenerator\ModuleBuilder\Module\Controller;
use TheGenerator\ModuleBuilder\Module\Model;
use TheGenerator\ModuleBuilder\Module\Request;
use TheGenerator\ModuleBuilder\Module\Route;
use TheGenerator\ModuleBuilder\Module\Migration;

class Module
{
    protected Model $model;
    protected Route $route;
    protected Controller $controller;
    protected Request $request;
    protected Migration $migration;
    // protected Factory $factory;
    // protected Seeder $seeder;

    public function setModel(Model $model): void {
        $this->model = $model;
    }
    
    public function setRoute(Route $route): void {
        $this->route = $route;
    }

    public function setController(Controller $controller): void {
        $this->controller = $controller;
    }

    public function setRequest(Request $request): void {
        $this->request = $request;
    }

    public function setMigration(Migration $migration): void {
        $this->migration = $migration;
    }

}