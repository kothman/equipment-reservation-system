<?php
namespace Kothman\ERS;

require_once __DIR__ . '/../../vendor/autoload.php';

class Router {
    /**
     * An array of all routes.
     *
     * Each route is an array of key/value pairs, in the following format:
     * [ method => 'GET|POST|PATCH|PUT|DELETE|*',
     *   pattern => '/route/[parameter]/[parameter2]',
     *   handler => ExampleController::class,
     *   view => 'index.html' ]
     **/
    
    protected $routes = [];
    protected $status404;

    public function __construct() {
        $this->status404 = new Route('*', '404', ErrorController::class, 'index', '404.html');        
    }

    public function getRoute(string $queryString, string $requestMethod): Route {
        foreach($this->routes as $route) {
            if($route->matchesPattern($queryString) && $route->matchesMethod($requestMethod)) {
                return $route;
            }
        }
        return $this->status404;
    }
    
     /**
      * This function is responsible for adding data to the array of routes, and trying to ensure
      * the route data is valid.
      * See the  $routes variable for the data structure.
      *
      * @param string       $requestMethod     'GET|POST|PATCH|PUT|DELETE|*'
      * @param string       $pattern    '/route/[parameter]/[parameter2]'
      * @param string       $controller  ExampleController::class
      * @param string       $controllerMethod 'index'
      * @param string       $view       'index.html'
      * @return void
      */
    public function match(string $requestMethod, string $pattern, string $controller, string $controllerMethod, string $view): void {
        $this->routes[] = new Route($requestMethod, $pattern, $controller, $controllerMethod, $view);
    }

    public function set404(string $controller, string $controllerMethod, string $view): void {
        $this->status404 = new Route('*', '404', $controller, $controllerMethod, $view);
    }

}
