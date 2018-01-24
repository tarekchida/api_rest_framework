<?php

namespace Core;

use Core\Request;

/**
 * Description of Router
 *
 * @author Tarek.Chida
 */
class Router {

    protected $routes = [];

    /**
     * return routes array
     * @return type
     */
    function getRoutes() {
        return $this->routes;
    }

    /**
     * Add get route
     * @param type $path
     * @param type $method
     */
    public function get($path, $method) {
        list( $controller, $action ) = explode("#", $method);
        $route['methode'] = "GET";
        $route['controller'] = CONTROLLERS_PATH . '\\' . $controller;
        $route['action'] = $action;
        $this->routes[$path] = $route;
    }

    /**
     * Add post route
     * @param type $path
     * @param type $method
     */
    public function post($path, $method) {
        list( $controller, $action ) = explode("#", $method);
        $route['methode'] = "POST";
        $route['controller'] = CONTROLLERS_PATH . '\\' . $controller;
        $route['action'] = $action;
        $this->routes[$path] = $route;
    }

    /**
     * dispatch route
     * @param type $uri
     * @param type $request_methode
     */
    public function dispatch($uri, $request_methode) {

        $routeUrl = explode('?', $uri);

        foreach ($this->routes as $route => $params) {

            if ($routeUrl[0] == $route) {

                if ($params['methode'] != $request_methode) {
                    $this->routeError('Methode ' . $request_methode . ' not permitted for this url');
                }
                $input = $this->getRequestData($params['methode']);
                $request = new Request($input, $params['methode'], $routeUrl[0]);
                $this->doCallback($params, $request);
                return FALSE;
            }
        }
        $this->routeError('Url not found : ' . $routeUrl[0]);
    }

    /**
     * Test then do route Callback
     * @param type $params
     * @param type $request
     */
    private function doCallback($params, $request) {

        if (is_callable(array($params['controller'], $params['action']))) {
            call_user_func_array([new $params['controller'], $params['action']], array($request));
        } else {
            $this->routeError('Callback not found : ' . $params['controller'] . '|' . $params['action']);
        }
    }

    /**
     * Get request data by methode [POST|GET]
     * @param type $methode
     * @return array
     */
    private function getRequestData($methode) {

        switch ($methode) {
            case 'POST':
                $data = $this->filterRequestData($_POST, INPUT_POST);
            case 'GET':
                $data = $this->filterRequestData($_GET, INPUT_GET);
                break;
            default : $data = array();
                break;
        }
        return $data;
    }

    /**
     * Filter Request data
     * @param type $input
     * @param type $methode
     * @return type
     */
    private function filterRequestData($input, $methode) {
        $data = array();
        foreach ($input as $key => $value) {
            $data[$key] = filter_input($methode, $key, FILTER_DEFAULT);
        }
        return $data;
    }

    /**
     * Callback default contrller
     * @param type $error
     */
    private function routeError($error) {
        call_user_func_array([ new BaseController, 'routeNotFound'], array($error));
    }

}
