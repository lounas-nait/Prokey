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
        
        // var_dump($path);
        // var_dump($method);
        if (isset($this->routes[$method][$path])) {
            $handler = $this->routes[$method][$path];
            if (is_callable($handler)) {
                return call_user_func($handler);
            } elseif (is_string($handler)) {
                list($controllerName, $actionName) = explode('@', $handler); 
                $controllerClass = "App\\Controllers\\$controllerName"; /* HomeController */
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    if (method_exists($controller, $actionName)) {
                        return $controller->$actionName();
                    } else {
                        http_response_code(500);
                        echo "Method $actionName not found in controller $controllerName.";
                    }
                } else {
                    http_response_code(500);
                    echo "Controller class $controllerName not found.";
                }
            }
        } else {
            http_response_code(404);
            echo "Route not found.";
        }
    }

    public function getRoutes() {
        return $this->routes;
    }   

}