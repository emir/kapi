<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

$settings['settings'] = require __DIR__ . '/src/config.php';

// Instantiate the app
$app = new \Slim\App($settings);

// DIC configuration
$container = $app->getContainer();

// View renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($settings['settings']['db']);
$capsule->bootEloquent();
$capsule->setAsGlobal();

// Routes
$urls = require __DIR__ . '/src/routes.php';

foreach ($urls as $url) {
    $app->{ $url['0'] }($url[1], '\App\Controllers\\' . $url[2]);
}

// Documentation
$app->get('/docs', function ($request, $response, $args) use ($urls) {
    return $this->view->render($response, 'docs.phtml', [
        'urls' => $urls,
    ]);
});

$app->run();
