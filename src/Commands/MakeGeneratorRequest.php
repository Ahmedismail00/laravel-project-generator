<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand;

class MakeGeneratorRequest extends RequestMakeCommand
{

    protected $signature = 'generator:request {name} {--type}';

    protected function getStub()
    {
        return base_path('/stubs/request.generator.stub');
    }
}
