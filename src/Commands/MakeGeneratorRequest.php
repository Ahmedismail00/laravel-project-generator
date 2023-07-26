<?php

namespace Isayama3\TheGenerator\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand;

class MakeGeneratorRequest extends RequestMakeCommand
{

    protected $signature = 'generator:request {name} {--type}';

    protected $description = 'create a new custom request class for the generator';

    protected function getStub()
    {
        return base_path('/stubs/request.generator.stub');
    }
}
