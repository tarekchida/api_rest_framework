<?php

namespace Core;

/**
 * Description of BaseController
 *
 * @author Tarek.Chida
 */
use Core\Response;

class BaseController {

    function __construct() {
        
    }

    /**
     * route not found
     * @param type $error
     * @return type
     */
    public function routeNotFound($error = 'URL not found') {
        return $this->response(404, $error);
    }

    /**
     * Response Json methode
     * @param type $status
     * @param type $message
     * @param type $data
     * @return type
     */
    public function response($status = 200, $message = NULL, $data = array()) {
        $response = new Response($status, $message, $data);
        echo $response->toJSON();
        exit();
    }

}
