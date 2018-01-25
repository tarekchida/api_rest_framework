<?php

namespace App\Controllers;

use Lib\BaseController;
use Lib\Request;

/**
 * Description of IndexController
 *
 * @author Tarek.Chida
 */
class IndexController extends BaseController {

    public function __construct() {
        
    }

    public function home(Request $request) {

        return $this->response(API_SUCCESS, 'Api Rest Framework', $request->getInputArray());
    }

}
