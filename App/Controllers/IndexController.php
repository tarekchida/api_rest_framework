<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Request;

/**
 * Description of IndexController
 *
 * @author Tarek.Chida
 */
class IndexController extends BaseController {

    public function __construct() {
        
    }

    public function home(Request $request) {

        return $this->response(API_SUCCESS, 'Api Rest Framwork', $request->getInputArray());
    }

}
