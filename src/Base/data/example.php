<?php

return [
    // Name for Model, Route, Controller, View, Migration, Factory, Seeder, Test, Observer, Request, Resource, Repository, Services
    "name" => "user",
    'request_type' => 'api', // api || web
    "fields" => [
        [
            "name"=>"name",
            "type"=>"string", 
            "validation"=>[
                "required",
            ]
        ],
    ],
    "relations" => [
        [
            "relation_name"=>"",    // orders
            "relation_type"=>"",    // hasMany
            "relation_model"=>"",   // order
        ]
    ],
    "optional_options"=>[
        // "soft_deletes" => true,
        // "observer"=> true,
        // "resource"=> true,
        // "seeder"=> true,
        // "factory"=> true,
        // "test"=> true,
        // "repository"=> true,
        // "services"=> true,
    ]
];
