<?php
/**
 * src/lib/Route.php
 *
 * Responsible for defining the data structure of a route.
 */
namespace Kothman\ERS;

use \Kothman\ERS\Controller;

require_once __DIR__ . '/../../vendor/autoload.php';

class Route {

    public function __construct(protected string $requestMethod, protected string $pattern, protected string $controller, protected $controllerMethod, protected string $view) {

    }

    public function matchesPattern(string $queryString): bool {
        return $this->pattern == $queryString || $this->pattern == '*';
    }

    public function matchesMethod(string $requestMethod): bool {
        return $this->requestMethod == $requestMethod;
    }

    public function getController() {
        return new $this->controller();
    }

    public function getControllerMethod() {
        return $this->controllerMethod;
    }

    public function getView(): string {
        return $this->view;
    }
    
}
