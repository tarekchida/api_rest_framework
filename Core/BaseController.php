<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core;

use Core\Response;

class BaseController {

    function __construct() {
        
    }

    public function routeNotFound($error = 'URL not found') {
        return $this->response(API_NOT_FOUND, $error);
    }

    /**
     * 
     * @param type $status
     * @param type $message
     * @param type $data
     * @return type
     */
    public function response($status, $message = NULL, $data = array()) {
        $response = new Response($status, $message, $data);
        echo $response->toJSON();
    }

}
