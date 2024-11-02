<?php
require_once 'middleware/AuthMiddleware.php';

class Router
{
    private array $routes = [];
    private string $secretKey = 'secret';
    private $authMiddleware;
    private const HTTP_METHODS = ['GET', 'POST', 'PUT', 'DELETE'];

    public function __construct()
    {
        $this->authMiddleware = new AuthMiddleware($this->secretKey);
        $this->loadRoutes();
    }

    private function loadRoutes(): void
    {
        //blog protected routes -----
        $this->addRoute('GET', '/my-blog-api/posts', 'BlogController', 'getPosts', true);
        $this->addRoute('GET', '/my-blog-api/posts/{id}', 'BlogController', 'getPost', true);
        $this->addRoute('POST', '/my-blog-api/posts', 'BlogController', 'createPost', true);
        $this->addRoute('PUT', '/my-blog-api/posts/{id}', 'BlogController', 'updatePost', true);
        $this->addRoute('DELETE', '/my-blog-api/posts/{id}', 'BlogController', 'deletePost', true);

        //user routes ----
        $this->addRoute('POST', '/my-blog-api/login', 'UserController', 'login');
        $this->addRoute('POST', '/my-blog-api/register', 'UserController', 'registerUser');
    }

    public function addRoute(string $method, string $path, string $controller, string $action, bool $requiresAuth = false): void
    {
        if (!in_array($method, self::HTTP_METHODS)) {
            throw new InvalidArgumentException("Invalid HTTP method: $method");
        }

        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action,
            'requiresAuth' => $requiresAuth,
        ];
    }

    //check if the request path matches any of the routes
    public function resolve(string $requestMethod, string $requestPath): ?array
    {

        foreach ($this->routes as $route) {

            $pattern = $this->convertPathToRegex($route['path']);
            $matches = [];

            // check if the request path matches the route pattern
            if ($this->matchRoute($route['method'], $requestMethod, $pattern, $requestPath, $matches)) {

                //check if the route requires authentication
                if ($route['requiresAuth']) {

                    $this->authMiddleware->handle();
                }

                //get the controller and action from the route                
                array_shift($matches);
                $controller = new $route['controller']($this->authMiddleware);
                return [$controller, $route['action'], $matches];
            }
        }
        return null;
    }

    //converts a path like /my-blog-api/posts/{id} to a regex pattern like /my-blog-api/posts/(\d+)  
    private function convertPathToRegex(string $path): string
    {
        return preg_replace('/{(\w+)}/', '(\d+)', $path);

    }

    //matches the request method and path against a route's method and pattern returns true if the route matches
    private function matchRoute(string $routeMethod, string $requestMethod, string $pattern, string $requestPath, array &$matches): bool
    {
        return $routeMethod === $requestMethod && preg_match('#^' . $pattern . '$#', $requestPath, $matches);
    }
}
