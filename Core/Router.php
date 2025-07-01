<?php 

namespace Core;

use Core\Middleware\Middleware;
use Exception;

class Router 
{   
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function resources($uri, $controller)
    {
        return $this->add('resources', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method) 
    {
        foreach ($this->routes as $route) {
            // $uri = rtrim($uri, '/');

            // if ($route['method'] === 'resources' && $route['uri'] === substr($uri, 0, strrpos($uri, '/'))) {
            //     [$controllerClass] = $route['controller'];  

            //     if (class_exists($controllerClass)) {
            //         $controllerInstance = new $controllerClass();

            //         $controllerMethod = $this->getResourceMethod($method, $uri);
            //         if (method_exists($controllerInstance, $controllerMethod)) {
            //             $controllerInstance->$controllerMethod();
            //             return;
            //         } else {
            //             throw new Exception("Method {$controllerMethod} not found in controller {$controllerClass}");
            //         }
            //     } else {
            //         throw new Exception("Controller class {$controllerClass} not found");
            //     }
            // }
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
            
                [$controllerClass, $controllerMethod] = $route['controller'];  
                if (class_exists($controllerClass)) {
                    $controllerInstance = new $controllerClass();
                    if (method_exists($controllerInstance, $controllerMethod)) {
                        $controllerInstance->$controllerMethod();
                        return;
                    } else {
                        throw new Exception("Method {$controllerMethod} not found in controller {$controllerClass}");
                    }

                } else {
                    throw new Exception("Controller class {$controllerClass} not found");
                }
            }
        }
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
    
        $errorPage = base_path("Views/StatusPages/$code.php");
        
        if (file_exists($errorPage)) {
            require $errorPage;
        } else {
            require view("StatusPages/error.php");
        }

        die();
    }

    private function getResourceMethod($method, $uri)
    {
        $uri = rtrim($uri, '/');

        $segments = explode('/', $uri);

        if ($method === 'GET') {
            if (is_numeric(end($segments)) && count($segments) > 1) {
                return 'show';
            }

            return 'index';
        }
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}