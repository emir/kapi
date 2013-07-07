<?php
namespace KAPI;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Model;

error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once __DIR__.'/../vendor/autoload.php';

$app = new \Silex\Application();

$app->register(new \Silex\Provider\TwigServiceProvider(), [
  'twig.path' => __DIR__.'/templates',
]);

require_once __DIR__.'/../app/settings.php';
require_once __DIR__.'/../app/core.php';
require_once __DIR__.'/../app/models.php';
require_once __DIR__.'/../app/views.php';
require_once __DIR__.'/../app/urls.php';

\Orm::configure(Settings::DB_CONNECTION_STRING);
\Orm::configure('username', Settings::DB_USERNAME);
\Orm::configure('password', Settings::DB_PASSWORD);
\Orm::configure('driver_options', [
  \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);

foreach ($urls as $url) {
  // Binding all urls
  list($method, $route, $view) = $url;
  $app->$method($route, $view);
}

// Run app.
$app->run();