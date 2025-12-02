<?php 

namespace App\Core;


class Router {

    private $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get($path, $handler) {
        $this->routes['GET'][$path] = $handler;
    }

    public function post($path, $handler) {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch() { 
        
        $method = $_SERVER['REQUEST_METHOD']; /* GET */
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); /* '/prokey/public/' */

        $basePath = '/prokey/public'; 
        $path = preg_replace('#^' . preg_quote($basePath) . '#', '', $path); /* '/' */

        // GET /projects/123/show

        foreach ($this->routes[$method] as $route => $handler) {

            $routePattern = preg_replace('#\{[a-zA-Z_][a-zA-Z0-9_]*\}#', '([a-zA-Z0-9_-]+)', $route);
            $routePattern = '#^' . $routePattern . '$#';

            if (preg_match($routePattern, $path, $matches)) {
                array_shift($matches); 

                list($controllerName, $methodName) = explode('@', $handler);
                $controllerClass = 'App\\Controllers\\' . $controllerName;
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    if (method_exists($controller, $methodName)) {
                        return call_user_func_array([$controller, $methodName], $matches);
                    }
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    public function getRoutes() {
        return $this->routes;
    }   

}