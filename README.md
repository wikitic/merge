# Partners Control Application

> Under construction

## Version

```sh
$ php bin/console --version
Symfony 4.2.1
```

## Requirements

- PHP 7.2 or higher
- and the [usual Symfony application requirements][1]


## Installing

Clone this repository

```sh
$ git clone https://github.com/ProgramoErgoSum/asociacion
```

Install application with composer and yarn

```sh
$ composer install
$ yarn install
```

Run application in dev mode <http://localhost:8000>
```sh
$ php bin/console server:run
$ yarn encore dev-server --hot
```

Execute this command to run tests
```sh
$ php bin/phpunit tests
```

Compile application
```sh
$ yarn encore production
```

[1]: https://symfony.com/doc/current/reference/requirements.html
