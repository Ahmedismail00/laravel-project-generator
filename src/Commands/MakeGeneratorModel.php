<?php

namespace Isayama3\TheGenerator\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;

class MakeGeneratorModel extends ModelMakeCommand
{

    protected $signature = 'generator:model {name} {--policy} {--force} {--all} {--migration} {--factory} {--seed} {--controller} {--resource} {--api} {--pivot}';

    protected $description = 'create a new custom model class for the generator';

    protected function getStub()
    {
        return base_path('/stubs/model.generator.stub');
    }
}
