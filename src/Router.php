<?php
namespace Kothman\ERS;

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

    public function __construct(protected string $routesFilepath) {
        
    }

     /**
      * This function is responsible for adding data to the array of routes, and trying to ensure
      * the route data is valid.
      * See the  $routes variable for the data structure.
      *
      * @param string       $method     'GET|POST|PATCH|PUT|DELETE|*'
      * @param string       $pattern    '/route/[parameter]/[parameter2]'
      * @param Controller   $handler    ExampleController::class
      * @param string       $view       'index.html'
      * @return void
      */
    public function match(string $method, string $pattern, Controller $handler, string $view): void {
        $this->routes[] = [
            'method'    => $method,
            'pattern'   => $pattern,
            'handler'   => $handler,
            'view'      => $view,
        ];
    }

    public function set404(Controller $handler, string $view): void {
        
    }

    public function handle(string $queryString) {
        foreach($this->routes as $route) {
            if($route['pattern'] === $queryString) {
                return $route;
            }
        }
        return $this->status404;
    }
}
