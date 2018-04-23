# KAPI: Doors for PHP - v1.0.0

[![Build Status](https://travis-ci.org/emir/kapi.svg?branch=master)](https://travis-ci.org/emir/kapi.svg?branch=master)

Slim Framework based simple helper to generate RESTful API's and applications, requires PHP 7.

KAPI means "door" in Turkish.

## Creating a Project skeleton

    git clone https://github.com/emir/kapi myproject
    cd myproject
    composer install

It will create an example project.

## Edit Configuration

    $EDITOR .env

## Migrations

    phinx migrate

## Running the Project

    cd myproject
    php -S localhost:8080 -t public

That's all! :)

## Getting Started

You should define your URLs in *routes.php*:

```php
# src/routes.php
<?php

$urls = [
  ['get', '/books', 'BooksController::index', 'List all books.']
];
```

Create your models:

```php
# src/Models/Book.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];
}
```

Create your Controllers and methods:

```php
# src/Controllers/BooksController.php
<?php

namespace App\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Slim\Http\Request;
use Slim\Http\Response;

class BooksController extends AbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response): Response
    {
        $books = Book::all();
        
        return $response->withJson($books);
    }
}
```

Done!
