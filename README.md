# Slimvc

## Overview
Slimvc is a lightweight framework.
Slim is the main structure, Model is Eloquent and View is Twig.
The migration has adopted a sql migration.
this project created for study.
I plan to upgrade if I have time.

## HOWTO
[Document](https://github.com/tikasan/wpKadai/blob/master/doc/howto.md)

### Install
```bash
$ git https://github.com/tikasan/wpKadai
$ composer install
$ composer setup
```

### migration
```bash
$ composer db-up
$ composer db-down
```

#### Main functions

- Routing(Slim)
- Twig(Template engine)
- Migration(SQL Migration)
- ORM(eloquent)
- Validation(eloquent)
- Pagination

##### unfinished
- CSRF measures
- User authentication

---

#### Link

##### Slim(Controller)

- [xsanisty/SlimStarter: Starter Application built on Slim Framework in MVC (and HMVC) environment](https://github.com/xsanisty/SlimStarter)
- [itsgoingd/slim-facades: "Static" interface for various Slim features](https://github.com/itsgoingd/slim-facades)
- [slimphp/Slim: Slim Framework source code](https://github.com/slimphp/Slim)

##### Twig(View)

- [slimphp/Slim-Views: Slim Framework custom views](https://github.com/slimphp/Slim-Views)
- [twigphp/Twig: Twig, the flexible, fast, and secure template language for PHP](https://github.com/twigphp/Twig)
- [twigphp/Twig-extensions: Twig extensions](https://github.com/twigphp/Twig-extensions)


##### eloquent(Model)
- [illuminate/database: [READ ONLY] Subtree split of the Illuminate Database component (see laravel/framework)](https://github.com/illuminate/database)

##### lib-migration(SQL Migration)

- [LibMigration](http://kohkimakimoto.github.io/lib-migration/)

##### Flexible-PHP-Pagination(Paging)

- [Modularr/Flexible-PHP-Pagination: Flexible PHP Pagination by Modularr](https://github.com/Modularr/Flexible-PHP-Pagination)
