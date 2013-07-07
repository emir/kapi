# KAPI: Doors for PHP - v0.1

Silex based simple helper to generate RESTful API's and applications, requires PHP 5.4.

KAPI means "door" in Turkish. The main structure looks like Django.

  - urls.php
  - models.php
  - views.php
  - templates/

## Creating a Project Skeleton

    git clone https://github.com/f/kapi myproject

It will create an example project using SQLite as DB.

## Running the Project

    cd myproject
    php -S localhost:8080

That's all! :)

# Getting Started

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