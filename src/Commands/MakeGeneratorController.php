<?php

namespace App\Console\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;

class MakeGeneratorController extends ControllerMakeCommand
{
    protected $signature = 'generator:controller {name} {--type=} {--api} {--requests} {--empty} {--invokable} {--resource} {--singleton} {--parent} {--model==} {--creatable}';

    protected function getStub()
    {
        $stub = null;

        if ($type = $this->option('type')) {
            $stub = "/stubs/controller.{$type}.stub";
        } elseif ($this->option('parent')) {
            $stub = $this->option('singleton')
                        ? '/stubs/controller.nested.singleton.stub'
                        : '/stubs/controller.nested.stub';
        } elseif ($this->option('model')) {
            $stub = '/stubs/controller.model.stub';
        } elseif ($this->option('invokable')) {
            $stub = '/stubs/controller.invokable.stub';
        } elseif ($this->option('singleton')) {
            $stub = '/stubs/controller.singleton.stub';
        } elseif ($this->option('resource')) {
            $stub = '/stubs/controller.stub';
        }
        if ($this->option('api') && is_null($stub)) {
            $stub = 'app/Helpers/Base/stubs/controller.generator.api.stub';
        } elseif ($this->option('api') && ! is_null($stub) && ! $this->option('invokable')) {
            $stub = 'app/Helpers/Base/stubs/controller.generator.api.stub';
        }

        $stub ??= '/app/Helpers/Base/stubs/controller.generator.api.stub';

        return $this->resolveStubPath($stub);

        // return $this->resolveStubPath('app/Helpers/Base/stubs/controller.generator.api.stub');
    }
}
