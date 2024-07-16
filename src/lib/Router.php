<?php
namespace Kothman\ERS;

require_once __DIR__ . '/../../vendor/autoload.php';

class Router {
    
    public function __construct(protected $routes = [],
                                protected Route|null $status404 = null,
                                protected Route|null $currentRoute = null,
                                protected string $groupPrefix = '') {
        $this->status404 = new Route('*', '404', ErrorController::class, 'index', '404.html');        
    }

    public function getRoute(string $requestURI, string $requestMethod): Route {
        foreach($this->routes as $route) {
            if($route->matchesPattern($requestURI) && $route->matchesMethod($requestMethod)) {
                $this->currentRoute = $route;
                return $route;
            }
        }
        $this->currentRoute = $this->status404;
        return $this->status404;
    }
    
     /**
      * This function is responsible for adding data to the array of routes, and trying to ensure
      * the route data is valid.
      *
      * @param string       $requestMethod     'GET|POST|PATCH|PUT|DELETE|*'
      * @param string       $pattern    '/route/[parameter]/[parameter2]'
      * @param string       $controller  ExampleController::class
      * @param string       $controllerMethod 'index'
      * @param string       $view       'index.html'
      * @return void
      */
    public function match(string $requestMethod, string $pattern, string $controller, string $controllerMethod, string $view): void {
        $this->routes[] = new Route($requestMethod, $this->groupPrefix . $pattern, $controller, $controllerMethod, $view);
    }

    public function group(string $prefix, \Closure $groupingCallback) {
        $this->setGroupPrefix($prefix);
        $groupingCallback();
        $this->unsetGroupPrefix($prefix);
    }

    protected function setGroupPrefix(string $prefix) {
        $this->groupPrefix = $prefix;
    }
    protected function unsetGroupPrefix(string $prefix) {
        $this->groupPrefix = '';
    }

    public function set404(string $controller, string $controllerMethod, string $view): void {
        $this->status404 = new Route('*', '404', $controller, $controllerMethod, $view);
    }

}
