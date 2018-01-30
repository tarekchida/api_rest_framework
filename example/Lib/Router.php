<?php

namespace Lib;

use Lib\Request;

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
        $route['method'] = "GET";
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
        $route['method'] = "POST";
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

                if ($params['method'] != $request_methode) {
                    $this->routeError('method ' . $request_methode . ' not permitted for this url');
                }
                $input = $this->getRequestData($params['method']);
                $request = new Request($input, $params['method'], $routeUrl[0]);
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
     * Get request data by method [POST|GET]
     * @param type $method
     * @return array
     */
    private function getRequestData($method) {

        switch ($method) {
            case 'POST':

                $data = $this->filterRequestData($_POST, INPUT_POST);

                if (isset($_SERVER["CONTENT_TYPE"]) && $_SERVER["CONTENT_TYPE"] == "application/json") {
                    $data = json_decode(file_get_contents('php://input'), TRUE);
                }
                break;
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
     * @param type $method
     * @return type
     */
    private function filterRequestData($input, $method) {
        $data = array();
        foreach ($input as $key => $value) {
            $data[$key] = filter_input($method, $key, FILTER_DEFAULT);
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
