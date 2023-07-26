<?php

namespace Isayama3\TheGenerator\ModuleBuilder\Module\Types;

use Isayama3\TheGenerator\ModuleBuilder\Module\Controller;
use Isayama3\TheGenerator\ModuleBuilder\Module\Model;
use Isayama3\TheGenerator\ModuleBuilder\Module\Request;
use Isayama3\TheGenerator\ModuleBuilder\Module\Route;
use Isayama3\TheGenerator\ModuleBuilder\Module\Migration;

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