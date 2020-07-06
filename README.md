Symfony UBI Transport technical test
========================

Requirements
------------

  * PHP 7.4.7 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements][1].

Installation
------------
Composer:

```bash
$ cd ubitransport
$ composer install
```

Doctrine (SQLite):

```bash
$ cd ubitransport
$ bin/console doctrine:migrations:migrate
$ bin/console doctrine:fixtures:load
```

Usage
-----

Api documentation :
http://your_host/api

Tests
-----
Execute this command to run tests:

```bash
$ cd ubitransport/
$ ./bin/phpunit
```

[1]: https://symfony.com/doc/current/reference/requirements.html
