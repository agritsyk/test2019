<?php

declare(strict_types=1);

class Router
{
    /**
     * @var array
     */
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include ($routesPath);
    }

    private function getURI(): string
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        return trim($requestUri, '/');
    }

    public function run(): void
    {
        $uri = $this->getURI();
        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~^$uriPattern$~", $uri)) {

                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);

                $segments = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once ($controllerFile);
                }

                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }
        }
    }
}