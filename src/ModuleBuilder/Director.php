<?php

namespace TheGenerator\ModuleBuilder;

class Director
{
    private Builder $builder;


    public function setBuilder(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function changeBuilder(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function makeModule()
    {
        return $this->builder->getModule();
    }
}