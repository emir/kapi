<?php

namespace Tests;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;
    
    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Slim\Http\Response
     * @throws \Slim\Exception\MethodNotAllowedException
     * @throws \Slim\Exception\NotFoundException
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock([
            'REQUEST_METHOD' => $requestMethod,
            'REQUEST_URI' => $requestUri,
        ]);
        
        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);
        
        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }
        
        $dotenv = new \Dotenv\Dotenv(__DIR__ . '/..');
        $dotenv->load();
        
        // Set up a response object
        $response = new Response();
        
        // Use the application settings
        $settings['settings'] = require __DIR__ . '/../src/config.php';
        
        // Instantiate the application
        $app = new App($settings);
        
        // View renderer
        $container['view'] = function ($c) {
            $settings = $c->get('settings')['renderer'];
            return new \Slim\Views\PhpRenderer($settings['template_path']);
        };
        
        // Monolog
        $container['logger'] = function ($c) {
            $settings = $c->get('settings')['logger'];
            $logger = new \Monolog\Logger($settings['name']);
            $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
            $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
            return $logger;
        };
        
        // Eloquent
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($settings['settings']['db']);
        $capsule->bootEloquent();
        $capsule->setAsGlobal();
        
        // Routes
        $urls = require __DIR__ . '/../src/routes.php';
        
        foreach ($urls as $url) {
            $app->{$url['0']}($url[1], '\App\Controllers\\' . $url[2]);
        }

        // Process the application
        $response = $app->process($request, $response);
        
        // Return the response
        return $response;
    }
}
