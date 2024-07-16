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

    /**
     * @param string $requestMethod     The request method(s) to match against ['GET', 'POST', 'PATCH', 'DELETE'].
     *                                  '*' can be used as a fallback for any request method.
     * @param string $pattern           The pattern to use when checking the request URI. This uses PHP regular expression syntax,
     *                                  with parenthesis grouping each URL parameter. Trailing slashes are removed before saving the pattern.
     *                                  Examples:
     *                                      '/' matches the root URL, https://some.domain/
     *                                      '/user/create' matches https://some.domain/user/create
     *                                      '/user/show/([\w]+)?' matches https://some.domain/user/show/{ID}, where {ID} can be any letters,
     *                                          numbers, or an underscore.
     *                                      '*' matches any route, and should be only be used last
     *                                  See preg_match and preg_replace
     * @param string $controller        The class name of the Controller (not including the namespace)
     * @param string $controllerMethod  The method to call on the controller
     * @param string $view              The view to return data to, like index.html
     */
    public function __construct(protected string $requestMethod, protected string $pattern, protected string $controller, protected string $controllerMethod, protected string $view) {
        // Strip any trailing slashes, and surround the statement in parenthesis to prepare
        // for preg_match and pref_replace
        $this->pattern = trim($pattern, characters: '/');
    }

    /**
     * Checks if a supplied request URI matches this route's pattern, using preg_match. If this pattern
     * is '*', matchesPattern will always return true. Otherwise, it will surround $this->pattern with parenthesis
     * (to make sure that forward slashes don't need to be escaped) and check for matches using preg_match.
     *
     * @param string $requestURI
     * @returns bool
     */
    public function matchesPattern(string $requestURI): bool {
        if ($this->pattern == '*')
            return true;
        // Make sure to remove trailing slashes, since we did this when storing the pattern.
        $sanitizedRequestURI = trim($requestURI, '/');
        // preg_match returns 0 for no matches, and false for an invalid pattern
        // @todo Should probably move this into a separate function for unit testing
        if (preg_match('(^' . $this->pattern . '(\?.*)?$)', $sanitizedRequestURI))
            return true;
        $_ENV['REQUEST_URI'] = $requestURI;
        return false;
    }

    /**
     * Determines if a given method (GET, POST, PATH, DELETE) matches this route's requestMethod.
     * If this route's requestMethod is '*', matchesMethod will always return true.
     * 
     * @param string $requestMethod The request method of the current request.
     * @returns bool
     */
    public function matchesMethod(string $requestMethod): bool {
        return $this->requestMethod == $requestMethod;
    }

    /**
     * Creates and returns a new instance of this route's controller.
     *
     * @return BaseController
     */
    public function getController() {
        return new $this->controller();
    }

    /**
    * Returns the string name of this route's controller method, for the App to call on the
    * controller instance.
    *
    * @return string Controller method
    */
    public function getControllerMethod() {
        return $this->controllerMethod;
    }

    /**
    * Returns a string name of the view representing this route.
    *
    * @return string
    */
    public function getView(): string {
        return $this->view;
    }
    
}
