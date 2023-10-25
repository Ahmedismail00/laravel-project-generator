<?php

namespace Isayama3\TheGenerator\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;

class MakeGeneratorController extends ControllerMakeCommand
{
    protected $signature = 'generator:controller {name} {--type=} {--api} {--requests} {--empty} {--invokable} {--resource} {--singleton} {--parent} {--model==} {--creatable}';

    protected $description = 'create a new custom Controller class for the generator';

    protected function getStub()
    {
        $stub = null;

        if ($type = $this->option('type')) {
            $stub = base_path("stubs/controller.{$type}.stub");
        } elseif ($this->option('parent')) {
            $stub = $this->option('singleton')
                ? base_path('stubs/controller.nested.singleton.stub')
                : base_path('stubs/controller.nested.stub');
        } elseif ($this->option('model')) {
            $stub = base_path('stubs/controller.model.stub');
        } elseif ($this->option('invokable')) {
            $stub = base_path('stubs/controller.invokable.stub');
        } elseif ($this->option('singleton')) {
            $stub = base_path('stubs/controller.singleton.stub');
        } elseif ($this->option('resource')) {
            $stub = base_path('stubs/controller.stub');
        }
        if ($this->option('api') && is_null($stub)) {
            $stub = ('vendor/isayama3/larave-project-generator/src/Base/stubs/controller.generator.api.stub');
        } elseif ($this->option('api') && !is_null($stub) && !$this->option('invokable')) {
            $stub = ('vendor/isayama3/larave-project-generator/src/Base/stubs/controller.generator.api.stub');
        }

        $stub ??= ('vendor/isayama3/larave-project-generator/src/Base/stubs/controller.generator.api.stub');

        return $this->resolveStubPath($stub);

        // return $this->resolveStubPath('app/Helpers/Base/stubs/controller.generator.api.stub');
    }
}
