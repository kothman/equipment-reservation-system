<?php
namespace Kothman\ERS;

use \Doctrine\ORM\EntityManager;

class App {

    /**
     * __construct(...) is called when an object is instantiated. Prefixing the class name with
     * the full namespace \Kothman\ERS\ is not necessary when this is already set as the namespace. 
     * 
     *      $myAppVariable = new \Kothman\ERS\App($myRouterVariable, $myEntityManagerVariable);
     * 
     * By declaring parameter variables as public, private, or protected, we don't need to
     * declare them outside of the __construct function, and assign
     * 
     *      $this->param = $param within __construct.
     *
     * @param Router $router
     * @param EntityManager $entityManager
     */
    public function __construct(protected Router $router,
                                protected EntityManager $entityManager,
                                protected \Twig\Environment $renderer) {

    }

    /**
     * The dispatch function causes App to handle HTTP requests by parsing server variables
     * set by Nginx. 
     * https://www.php.net/manual/en/reserved.variables.server.php
     *
     * @return void
     */
    public function dispatch(): void {
        // Data to be stored by controller
        $data = null;
        
        $route = $this->router->getRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        $_ENV['route'] = $route;
        
        // After getting the route, immediately run any beforeMiddleware
        $this->router->handleBefore($this);

        // Check for redirects set by middleware
        
        
        // Ensure a view exists for any given route. When not in dev mode,
        // errors will be caught and logged.
        if ( !file_exists($viewFullPath = __DIR__ . '/../resources/views/' . $route->getView())) {
            throw new \Error('File not found at ' . $viewFullPath);
        }
        $data = $this->_dispatchController($route);
        // Outputs the HTML for our webpage. This is the only echo statement that
        // should be used when utilizing Twig templating.
        echo $this->renderer->render($route->getView(), $data ?? []);
    }
    
    /**
     * Creates a new instance of the given controller, and returns the result of Controller::$controllerMethod
     *
     * @param Route $route The route specifying which controller and method should be dispatched.
     * @returns mixed
     */
    protected function _dispatchController(Route $route) {
        $controllerMethod = $route->getControllerMethod();
        $controller = $route->getController();
        return $controller->$controllerMethod();
    }
    
    /**
     * For debugging purposes, to show all of the magic variables available to use through
     * PHP-FPM and Nginx.
     */
    public function echoServerVariables(): void {
        echo "<pre>".htmlentities(print_r($this->router, true))."</pre>";

        echo "<pre>".htmlentities(print_r($_SERVER, true))."</pre>";
        echo "<pre>".htmlentities(print_r($_COOKIE, true))."</pre>";
        echo "<pre>".htmlentities(print_r($_ENV, true))."</pre>";
        echo "<pre>".htmlentities(print_r($_FILES, true))."</pre>";
        echo "<pre>".htmlentities(print_r($_GET, true))."</pre>";
        echo "<pre>".htmlentities(print_r($_POST, true))."</pre>";
        echo "<pre>".htmlentities(print_r($_REQUEST, true))."</pre>";
        echo "<pre>".htmlentities(print_r($_SESSION, true))."</pre>";
    }

    public function db(): EntityManager {
        return $this->entityManager;
    }

    public function redirect(string $relativePath) {
        
    }
}
