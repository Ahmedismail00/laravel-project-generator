<?php

namespace Isayama3\TheGenerator\ModuleBuilder\Builders;

use Isayama3\TheGenerator\ModuleBuilder\Builder;
use Isayama3\TheGenerator\ModuleBuilder\Module\Controller;
use Isayama3\TheGenerator\ModuleBuilder\Module\Model;
use Isayama3\TheGenerator\ModuleBuilder\Module\Request;
use Isayama3\TheGenerator\ModuleBuilder\Module\Route;
use Isayama3\TheGenerator\ModuleBuilder\Module\Migration;
use Isayama3\TheGenerator\ModuleBuilder\Module\Types\Module;
use Isayama3\TheGenerator\ModuleBuilder\Module\Types\ApiModule;

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
