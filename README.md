# Laravel MVC Project Generator


---

## About

This package is responsible for generating laravel essential files for starting your application. 

You dont need to make make command for each file like contoller, model, ....etc.

It's only one command and you are ready to start your application.

## Installation

You can install the package via composer:
```bash
 composer require pi-space/notion-api-integration
```

## Usage

### Init module data
- After installing the package. There is a generated folder called `data` in our base bath directory with an example file for a module.
- The files in `data` directory are used to generate module files. 
- You need to add your own data in each file you gonna init.

```php
    return [
        "name" => "admin",
        "request_type" => "api",
        "fields" => [
        [
            "name"=>"age",
            "type"=>"integer",
            "options"=>[
                "nullable",
            ],
            "validation"=>[
                "required",
            ]
        ],
        [
            "name"=>"phone",
            "type"=>"string",
            "options"=>[
                "default",
                "nullable",
            ],
            "validation"=>[
                "required",
                "max:255",
            ]
        ],
        [
            "name"=>"password",
            "type"=>"string",
            "options"=>[
                "nullable",
            ],
            "validation"=>[
                "required",
                "max:255",
                "password"
            ]
        ]
    ],
    "relations" => [
        [
            "relation_name"=>"orders",
            "relation_type"=>"hasMany",
            "relation_model"=>"order",
        ],
        [
            "relation_name"=>"emails",
            "relation_type"=>"hasMany",
            "relation_model"=>"email",
        ],
    ],
    ];
```
### Generate module files

- Now you need to run this command to start creating your modules files.

- The command will also create the module files in `app/Http/Controllers` and `app/Models` and `database/migrations` and `app/Http/Resources` and `routes/api.php` or `routes/web.php` based on `request_type`.

```bash
php artisan generator:modules
```
## Changelog

Please see the CHANGELOG for more information on what has changed recently.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## Security Vulnerabilities

Please review our security policy on how to report security vulnerabilities.

## Credits

## License

The MIT License [MIT](https://choosealicense.com/licenses/mit/). Please see License File for more information.