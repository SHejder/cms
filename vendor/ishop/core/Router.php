<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 029 29.12.18
 * Time: 20:41
 */

namespace ishop;


use http\Url;
use mysql_xdevapi\Exception;

class Router
{

    protected static $routes = [];
    protected static $route = [];

    /**
     * @param string $regexp
     * @param array $route
     */
    public static function add(string $regexp, array $route = []): void
    {

        self::$routes[$regexp] = $route;

    }

    /**
     * @return array
     */
    public static function getRoutes(): array
    {

        return self::$routes;

    }


    /**
     * @param string $url
     * @throws \Exception
     */
    public static function dispatch(string $url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url))
        {
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new \Exception("Метод $controller::$action не найдена.", 404);
                }
            } else {

                throw new \Exception("Контроллер $controller не найдена.", 404);
            }

        } else {
            throw new \Exception('Страница не найдена.', 404);
        }

    }

    /**
     * @param string $url
     * @return bool
     *
     */
    public static function matchRoute(string $url): bool
    {

        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $k => $v)
                {
                    $route[$k] = $v;
                }
                if (empty($route['action']))
                {
                    $route['action'] = 'index';
                }
                if (!isset($route['prefix']))
                {
                    $route['prefix'] = '';
                }
                else
                {
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;

                return true;
            }
        }

        return false;
    }

    /**
     * @param string $name
     * @return string
     */
    protected static function upperCamelCase(string $name): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * @param string $name
     * @return string
     */
    protected static function lowerCamelCase(string $name): string
    {
        return lcfirst(self::upperCamelCase($name));

    }

    /**
     * @param string $url
     * @return string
     */
    protected static function removeQueryString(string $url): string
    {
        if ($url) {
            $params = explode('&', $url, 2);

            if (!strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return "";
            }
        }
    }

}