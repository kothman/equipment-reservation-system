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
    public function __construct(protected Router $router, protected EntityManager $entityManager, protected \Twig\Environment $renderer) {

    }

    /**
     * The dispatch function causes App to handle HTTP requests by parsing server variables
     * set by Nginx. 
     * https://www.php.net/manual/en/reserved.variables.server.php
     *
     * @return void
     */
    public function dispatch(): void {

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
}
