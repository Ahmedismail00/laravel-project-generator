<?php

namespace TheGenerator\ModuleBuilder\Builders;

use TheGenerator\ModuleBuilder\Builder;
use TheGenerator\ModuleBuilder\Module\Controller;
use TheGenerator\ModuleBuilder\Module\Model;
use TheGenerator\ModuleBuilder\Module\Request;
use TheGenerator\ModuleBuilder\Module\Route;
use TheGenerator\ModuleBuilder\Module\Migration;
use TheGenerator\ModuleBuilder\Module\Types\Module;
use TheGenerator\ModuleBuilder\Module\Types\ApiModule;

class ModuleBuilder extends Builder
{
    public function __construct(array $module_data)
    {
        $this->module_data = $module_data;
    }

    public function getModule(): Module
    {
        $module = new Module();
        $module->setModel($this->buildModel());
        $module->setRoute($this->buildRoute());
        $module->setController($this->buildController());
        $module->setRequest($this->buildRequest());
        $module->setMigration($this->buildMigration());
        return $module;
    }

    protected function buildModel(): Model
    {
        return new Model($this->module_data);
    }

    protected function buildRoute(): Route
    {
        return new Route($this->module_data);
    }

    protected function buildController(): Controller
    {
        return new Controller($this->module_data);
    }

    protected function buildRequest(): Request
    {
        return new Request($this->module_data);
    }

    protected function buildMigration(): Migration
    {
        return new Migration($this->module_data);
    }
}
