# KAPI: Doors for PHP - v0.1

[![Clone in Koding](http://kbutton.org/clone.png)](http://kbutton.org/f/kapi)

Silex based simple helper to generate RESTful API's and applications, requires PHP 5.4.

KAPI means "door" in Turkish. The main structure looks like Django.

  - urls.php
  - models.php
  - views.php
  - templates/

## Screenshots

![Screenshot1](http://i.imgur.com/b4eSEcE.png)
![Screenshot2](http://i.imgur.com/eT7Koe2.png)
![Screenshot3](http://i.imgur.com/PN9S0U7.png)
![Screenshot4](http://i.imgur.com/iJb6tji.png)

## Creating a Project Skeleton

    git clone https://github.com/f/kapi myproject
    cd myproject
    composer install

It will create an example project using SQLite as DB.

## Running the Project

    cd myproject
    php -S localhost:8080

That's all! :)

## Getting Started

You should define your URLs in *urls.php*:

```php
# app/urls.php
<?php
namespace KAPI;

$urls = [
  ['get', '/helloworld', 'KAPI\Views::helloworld']
];
```

Define your models:

```php
# models.php
<?php
namespace KAPI;

use \Model;

class Link extends Model {
  public static $_table = 'links';

  public $id;
  public $link;
  public $name;
}
```

And define your views on *views.php*:

```php
# app/views.php
<?php
namespace KAPI;

use \Model;

class Views extends Core\Views {

  public static function links($search = "") {
    $links = Model::factory('KAPI\Link')
      ->whereLike("name", "%$search%")
      ->findMany();

    return self::jsonMany($links);
  }
```

Done!

----
#### LICENSE

![CC SA](http://i.creativecommons.org/l/by-sa/3.0/88x31.png)

This work is licensed under the Creative Commons Attribution-ShareAlike 3.0 Unported License. To view a copy of this license, visit http://creativecommons.org/licenses/by-sa/3.0/.
