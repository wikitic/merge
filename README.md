# Partners Control Application

> Under construction

[![Build Status](https://travis-ci.org/ProgramoErgoSum/asociacion.svg?branch=master)](https://travis-ci.org/ProgramoErgoSum/asociacion)


## Version

```sh
$ php bin/console --version
Symfony 4.1.6
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
$ yarn encore dev --watch
```

Execute this command to run tests
```sh
$ ./bin/phpunit
```

Compile application
```sh
$ yarn encore production
```

[1]: https://symfony.com/doc/current/reference/requirements.html
