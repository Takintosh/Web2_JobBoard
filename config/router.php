<?php

class Router {
    private $routes = [];

    /**
     * Define a route for HTTP GET requests.
     *
     * @param string   $path       The route path.
     * @param callable $action     The controller action to execute.
     * @param mixed    $middleware Optional middleware to apply.
     */
    public function get($path, $action, $middleware = null) {
        $this->addRoute('GET', $path, $action, $middleware);
    }

    /**
     * Define a route for HTTP POST requests.
     *
     * @param string   $path       The route path.
     * @param callable $action     The controller action to execute.
     * @param mixed    $middleware Optional middleware to apply.
     */
    public function post($path, $action, $middleware = null) {
        $this->addRoute('POST', $path, $action, $middleware);
    }

    /**
     * Add a route to the collection.
     *
     * @param string   $method     The HTTP method (GET or POST).
     * @param string   $path       The route path.
     * @param callable $action     The controller action to execute.
     * @param mixed    $middleware Optional middleware to apply.
     */
    private function addRoute($method, $path, $action, $middleware) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    /**
     * Dispatch the request to the appropriate controller action.
     *
     * @param string $method The HTTP method (GET or POST).
     * @param string $path   The requested path.
     */
    public function dispatch($method, $path) {
        foreach ($this->routes as $route) {
            if ($route['method'] == $method && $route['path'] == $path) {
                if ($route['middleware']) {
                    (new $route['middleware'])->handle();
                }
                list($controller, $action) = $route['action'];
                (new $controller)->$action();
                return;
            }
        }

        // If route not found
        http_response_code(404);
        echo "404 Not Found";
    }
}
